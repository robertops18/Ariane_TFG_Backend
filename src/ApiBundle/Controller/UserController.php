<?php

namespace ApiBundle\Controller;

use AppBundle\Enum\DocumentTypeEnum;
use AppBundle\Entity\OnBoarding;
use Application\Sonata\MediaBundle\Entity\Media;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{
    /** Get profile info of the active User.
     *
     * @Route("/profile",methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Get User Profile"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function getProfileAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApplicationSonataUserBundle:User')->find($this->getUser()->getId());

        $data = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'name' => $user->getFirstname(),
            'surname' => $user->getLastname()
        ];

        $view = $this->view(['profile' => $data], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Logs in the User and returns token.
     *
     * @Route("/login",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Token created and returned"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="User not found"
     * )
     * @SWG\Response(
     *     response=403,
     *     description="User disabled or wrong password"
     * )
     * @SWG\Parameter(
     *       name="credentials",
     *       in="body",
     *       description="User and password in json format",
     *       required=true,
     *              @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="username", type="string"),
     *              @SWG\Property(property="password", type="string")
     *          )
     *     )
     * @SWG\Tag(name="User")
     *
     */
    public function loginAction(Request $request)
    {
        $username = $request->get('username');
        $pass = $request->get('password');
        $user = $this->getDoctrine()->getRepository('ApplicationSonataUserBundle:User')
            ->findOneBy(['username' => strtolower($username), 'enabled' => true]);
        if (!$user) {
            $view = $this->view(['error' => 'Usuario no encontrado.'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }
        if (!$user->isEnabled()) {
            $view = $this->view(['error' => 'Usuario no habilitado.'], Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }
        // Check Password
        if (!$this->get('security.password_encoder')->isPasswordValid($user, $pass)) {
            $view = $this->view(['error' => 'Contraseña incorrecta.'], Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }
        // Create JWT token
        $token = $this->get('lexik_jwt_authentication.encoder')->encode(['username' => $user->getUsername()]);
        // Return token

        $view = $this->view(['token' => $token, 'userId' => $user->getId(), 'groups' => $user->getGroupNames(), 'hasSign' => []], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Registers Firebase token on first User login in app.
     *
     * @Route("/register-token",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Register Token Firebase"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Error"
     * )
     * @SWG\Parameter(
     *       name="token",
     *       in="query",
     *       description="Token",
     *       required=true,
     *       type="string"
     *     )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function registerTokenAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $token = $request->get('token');
        $user = $em->getRepository('ApplicationSonataUserBundle:User')->find($this->getUser()->getId());
        if(!$user) {
            throw $this->createNotFoundException();
        }
        // Check Token no empty
        if(empty($token)) {
            throw $this->createNotFoundException();
        }
        // Register Token
        $user->setFirebaseToken($token);
        $em->persist($user);
        $em->flush();

        $view = $this->view(['message' => "Token register"], Response::HTTP_OK);
        return $this->handleView($view);
    }

    /** Change password.
     *
     * @Route("/change-password",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Password change success"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="User not found"
     * )
     * @SWG\Response(
     *     response=403,
     *     description="Wrong old password"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="The new password does not match"
     * )
     * @SWG\Parameter(
     *       name="changePassword",
     *       in="body",
     *       description="Password and password recovery in json format",
     *       required=true,
     *       @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="old_password", type="string"),
     *              @SWG\Property(property="new_password", type="string"),
     *              @SWG\Property(property="new_password_r", type="string")
     *          )
     *     )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */

    public function changePasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('ApplicationSonataUserBundle:User')->find($this->getUser()->getId());

        $old_password = $request->get('old_password');
        $password = $request->get('new_password');
        $passwordRepeat = $request->get('new_password_r');


        if (!$this->validUser($user, $old_password)) {
            $view = $this->view(['message' => 'La contraseña antigua no es correcta.'], Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        if (!$user) {
            $view = $this->view(['message' => 'Usuario no encontrado.'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }
        // Check Password equals
        if ($password != $passwordRepeat) {
            $view = $this->view(['message' => 'Las contraseñas no coinciden.'], Response::HTTP_BAD_REQUEST);
            return $this->handleView($view);
        }
        // Change Password
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $view = $this->view(['message' => "La contraseña se ha actualizado correctamente"], Response::HTTP_OK);
        return $this->handleView($view);

    }

    /** Recover password.
     *
     * @Route("/recovery-password",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Password reseted"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Email is required"
     * )
     * @SWG\Response(
     *     response=403,
     *     description="There is no user with this email"
     * )
     * @SWG\Parameter(
     *       name="email",
     *       in="query",
     *       description="email",
     *       required=true,
     *       type="string"
     *     )
     * @SWG\Tag(name="User")
     */
    public function recoveryPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $email = $request->get('email');
        if (!$email) {
            $view = $this->view(['message' => 'El email es requerido'], Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }
        $user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByEmail($email);
        if (!$user) {
            $view = $this->view(['message' => 'Su email no ha sido encontrado por favor verifique que se ha insertado correctamente y vuelve a presionar sobre recuperar contraseña'], Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }
        $password = $this->random_str(6);
        $email = $this->get('email.services');
        $email->sendRecoveryPasswordEmail($user, $password);
        // Change Password
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $view = $this->view(['message' => "Revise su correo que le ha llegado un email con las indicaciones para restablecer la contraseña"], Response::HTTP_OK);
        return $this->handleView($view);

    }

    /** Upload/updates avatar picture of active User.
     *
     * @Route("/update-avatar",methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Add Avatar to profile"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not Found"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="image",
     *     description="Photo",
     *     required=true,
     *     @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="image", type="string")
     *          )
     *   )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function updateAvatarAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ApplicationSonataUserBundle:User')->find($this->getUser()->getId());

        $image = $request->get('image');
        if (!is_null($image)) {

            $data = base64_decode($image);
            $file = $this->getParameter('files_temp_dir') . uniqid() . '.png';
            $actual = file_put_contents($file, $data);


            $media = new Media();
            $media->setBinaryContent($file);
            $media->setContext('s3');
            $media->setProviderName('sonata.media.provider.image');
            $media->setEnabled(true);
            $em->persist($media);
            $em->flush();

            //Borramos el archivo temporal
            unlink($file);

            $user->setAvatar($media);
            $em->persist($user);
            $em->flush();


            $view = $this->view(['message' => "Avatar actualizada correctamente"], Response::HTTP_OK);
            return $this->handleView($view);
        }

        $view = $this->view(["error" => "no hay imagen"], Response::HTTP_OK);
        return $this->handleView($view);
    }


    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int $length How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     * @throws \Exception
     */
    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    /**
     *
     * Validate user
     */
    private function validUser($user, $password)
    {

        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);

        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }

    private function getIpFromRequest()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


}
