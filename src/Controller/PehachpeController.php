<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Bundle\SecurityBundle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PehachpeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    private $twig;
    private $apikey;
    private $movies = [];
    private $poster = [];
    private $size = 200;
    private $_overview = [];
    private $_release_date = [];

    public function __construct(Environment $twig)   {

        $this->apikey = "aec57ed6f28065e07144f364df322c4c";
        $this->twig = $twig;
    }

    private function makeRequest()  { 

        $id = "";
        $vote = "";
        $pehachpe = "";
        $language = "";
        $title = "";
        $poster ="";
        $overview ="";
        $release_date ="";
       
        if(isset($_GET["movie_name"]))
        {
            $pehachpe = $_GET["movie_name"];
            $client = HttpClient::create();
            $response = $client->request('GET', "https://api.themoviedb.org/3/search/movie?api_key=$this->apikey&query=$pehachpe");
            if ($response->getStatuscode() === 200){
                $response = $response->toArray();
                foreach ($response["results"] as $results)
                {
                    foreach ($results as $key => $value) 
                    {
                        if ($key === "id")   {
                            $id = $value;
                        }
                        if ($key === "original_title")   {
                            $title = $value;    
                        }
                        if ($key === "poster_path")    {
                            $poster = "http://image.tmdb.org/t/p/w$this->size/" . $value;    
                        }
                        if ($key === "overview")   {
                            $overview = $value;    
                        }
                        if ($key === "release_date")  {
                            $release_date = $value;    
                        }
                        if ($key === "original_language")   {
                            $language = $value;    
                        }
                        if ($key === "vote_average")   {
                            $vote = $value;    
                        }
                    }
                    array_push($this->movies, ["vote" => $vote, "language" => $language, "id" => $id, "title" => $title, 
                    "poster" => $poster, "overview" => $overview, "release_date" => $release_date]);
                }        
            }
        } 
        elseif(isset($_GET["actor_name"]))
        {
            $search = $_GET["actor_name"];
            $client = HttpClient::create();
            $response = $client->request('GET', "https://api.themoviedb.org/3/search/person?api_key=$this->apikey&query=$search");
            if ($response->getStatuscode() === 200)
            {
                $response = $response->toArray();
                foreach ($response["results"] as $results)
                foreach($results["known_for"] as $known_for)
                {
                    foreach ($known_for as $key => $value) 
                    {
                        if ($key === "id")   {
                            $id = $value;
                        }
                        if ($key === "original_title")   {
                            $title = $value;    
                        }
                        if ($key === "poster_path")    {
                            $poster = "http://image.tmdb.org/t/p/w$this->size/" . $value;    
                        }
                        if ($key === "overview")   {
                            $overview = $value;    
                        }
                        if ($key === "release_date")   {
                            $release_date = $value;    
                        }
                        if ($key === "original_language")   {
                            $language = $value;    
                        }
                        if ($key === "vote_average")  {
                            $vote = $value;    
                        }
                    }
                array_push($this->movies, ["vote" => $vote, "language" => $language, 
                "id" => $id, "title" => $title, "poster" => $poster, "overview" => $overview, 
                "release_date" => $release_date]);
                } 
            }                
        } 
        if(isset($_GET["release_date"]))
        {
            $search = $_GET["release_date"];
            $client = HttpClient::create();   
            $response = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?api_key=$this->apikey&primary_release_date.gte=$search-01-01&primary_release_date.lte=$search-12-31");
            if ($response->getStatuscode() === 200){
                $response = $response->toArray();
                foreach ($response["results"] as $results)
                {
                    foreach ($results as $key => $value) 
                    {
                        if ($key === "id")   {
                            $id = $value;
                        }
                        if ($key === "original_title")   {
                            $title = $value;    
                        }
                        if ($key === "poster_path")    {
                            $poster = "http://image.tmdb.org/t/p/w$this->size/" . $value;    
                        }
                        if ($key === "overview")   {
                            $overview = $value;    
                        }
                        if ($key === "release_date")  {
                            $release_date = $value;    
                        }
                        if ($key === "original_language")   {
                            $language = $value;    
                        }
                        if ($key === "vote_average")   {
                            $vote = $value;    
                        }
                    }
                    array_push($this->movies, ["vote" => $vote, "language" => $language, "id" => $id, "title" => $title, 
                    "poster" => $poster, "overview" => $overview, "release_date" => $release_date]);
                }        
            }
        }
        if(isset($_GET["genre"]))
        {

            If ($_GET["genre"] == "action")   {
                $search = 28;
            } If ($_GET["genre"] == "adventure")   {
                $search = 12;
            } If ($_GET["genre"] == "animation")   {
                $search = 16;
            } If ($_GET["genre"] == "comedy")   {
                $search = 35;
            } If ($_GET["genre"] == "crime")   {
                $search = 80;
            } If ($_GET["genre"] == "documentary")   {
                $search = 99;
            } If ($_GET["genre"] == "drama")   {
                $search = 18;
            } If ($_GET["genre"] == "family")   {
                $search = 10751;
            } If ($_GET["genre"] == "fantasy")   {
                $search = 14;
            } If ($_GET["genre"] == "history")   {
                $search = 36;
            }  If ($_GET["genre"] == "horror")   {
                $search = 27;
            } If ($_GET["genre"] == "music")   {
                $search = 10402;
            } If ($_GET["genre"] == "mystery")   {
                $search = 9648;
            } If ($_GET["genre"] == "romance")   {
                $search = 10749;
            } If ($_GET["genre"] == "tv Movie")   {
                $search = 10770;
            } If ($_GET["genre"] == "thriller")   {
                $search = 53;
            } If ($_GET["genre"] == "western")   {
                $search = 37;            
            }
            $client = HttpClient::create();    //https://api.themoviedb.org/3/discover/movie?api_key=4f364df322c4c&with_genres=28
            $response = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?api_key=$this->apikey&with_genres=$search");
            if ($response->getStatuscode() === 200){
                $response = $response->toArray();
                foreach ($response["results"] as $results)
                {
                    foreach ($results as $key => $value) 
                    {
                        if ($key === "id")   {
                            $id = $value;
                        }
                        if ($key === "original_title")   {
                            $title = $value;    
                        }
                        if ($key === "poster_path")    {
                            $poster = "http://image.tmdb.org/t/p/w$this->size/" . $value;    
                        }
                        if ($key === "overview")   {
                            $overview = $value;    
                        }
                        if ($key === "release_date")  {
                            $release_date = $value;    
                        }
                        if ($key === "original_language")   {
                            $language = $value;    
                        }
                        if ($key === "vote_average")   {
                            $vote = $value;    
                        }
                    }
                    array_push($this->movies, ["vote" => $vote, "language" => $language, "id" => $id, "title" => $title, 
                    "poster" => $poster, "overview" => $overview, "release_date" => $release_date]);
                }        
            }
        }    
    }  

    public function index(Request $request) {

        $this->makeRequest();
        $response = $this->twig->render('pehachpe/index.html.twig',  [
            "movies" => $this->movies,
        ]);
        return new Response($response);
    }
}
