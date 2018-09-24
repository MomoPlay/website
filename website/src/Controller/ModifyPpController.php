<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Abraham\TwitterOAuth\TwitterOAuth;
use Endroid\Twitter\Client;

class ModifyPpController extends AbstractController
{
    /**
     * @Route("/modifypp", name="modify_pp")
     */
    public function index()
    {
        return $this->render('modify_pp/index.html.twig', [
            'controller_name' => 'ModifyPpController',
        ]);
    }

    /**
     * @Route("/modifypp", name="modify_pp_put", methods={"POST"})
     * @param Request $request
     * @param \Symfony\Component\Asset\Packages $assetsManager
     */
    public function putPp(Request $request, \Symfony\Component\Asset\Packages $assetsManager)
    {
        $consumerKey = "aaa";
        $consumerSecret = "aaaa";

        $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret);
        $client = new Client($twitterOAuth);

        $request->attributes->get(1);

        $image = $this->imageToBase64($assetsManager->getUrl('images/LogoBlack.png'));

        $client->postPp($image);
    }

    /**
     * @param string $path
     * @return string
     */
    private function imageToBase64(string $path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }
}
