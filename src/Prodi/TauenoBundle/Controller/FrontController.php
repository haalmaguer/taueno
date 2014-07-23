<?php

namespace Prodi\TauenoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontController extends Controller {

    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $categories = $dm->getRepository("TauenoBundle:Category")->findAll();
        return array("categories" => $categories);
    }

    /**
     * @Route("/contacto", name="contacto")
     * @Template()
     */
    public function contactoAction() {
        return array();
    }

    /**
     * @Route("/ayuda", name="ayuda")
     * @Template()
     */
    public function ayudaAction() {
        return array();
    }

    /**
     * @Route("/upload", name="upload")
     * @Template()
     */
    public function uploadAction() {
        $request = $this->getRequest();
    }

    /**
     * @Route("/create_anuncio", name="create_anuncio")
     * @Template()
     */
    public function createAction() {
        $request = $this->getRequest();
        echo "<pre>";
        print_r($request);
        die;
    }

    /**
     * @Route("/categories")
     * @Template()
     */
    public function categoriesAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $categories = $dm->getRepository("TauenoBundle:Category")->findAll();
        return array("categories" => $categories);
    }

    /**
     * @Route("/publish", name="publish")
     * @Template()
     */
    public function publishAction() {
        return array();
    }

    /**
     * @Route("/make_publish", name="make_publish")
     * @Template()
     */
    public function makepublishAction() {

        $dm = $this->get('doctrine_mongodb')->getManager();

        $request = $this->getRequest();
        $title = $request->get('title');
        $price = $request->get('price');
        $description = $request->get("description");
        $location = $request->get("location");
        $category_id = $request->get("category");
        $status = $request->get("status");
        $transporte = $request->get("transporte");
        $owner = $request->get("owner");
        $keywords = $request->get("keywords");

        $category = $dm->getRepository("TauenoBundle:Category")->find($category_id);
        
        $anuncio = new \Prodi\TauenoBundle\Document\Anuncio();
        $anuncio->setPrice($price)
                ->setActive(true)
                ->setTransporte($transporte)
                ->setDescription($description)
                ->setTitle($title)
                ->setLocation($location)
                ->setCategory($category)
                ->setPublishDate(new \DateTime())
                ->setStatus($status)
                ->setKeywords(implode(" ", $keywords))
                ->setOwner($owner);

        $dm->persist($anuncio);
        $dm->flush();

        return new \Symfony\Component\HttpFoundation\Response("guardado correctamente");
    }

    /**
     * @Route("/anuncio/{id}", name="anuncio")
     * @Template()
     */
    public function anuncioAction($id) {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $anuncio = $dm->getRepository("TauenoBundle:Anuncio")->find($id);
        return array("anuncio" => $anuncio);
    }

    /**
     * @Route("/remove_filter/{filter}", name="remove_filter")
     * @Template()
     */
    public function removeFilterAction($filter) {
        $this->get("session")->set($filter, false);
        return new \Symfony\Component\HttpFoundation\Response("ok");
    }

    /**
     * @Route("/set_factive", name="set_factive")
     * @Template()
     */
    public function setfactiveAction() {
        $factive = $this->getRequest()->get('factive');
        $this->get("session")->set("factive", $factive);
        return new \Symfony\Component\HttpFoundation\Response("ok");
    }

    /**
     * @Route("/chat/last_messages", name="last_messages")
     * @Template()
     */
    public function lastmessagesAction() {
        $messages = array();
        $messages['items'] = array();
        return new \Symfony\Component\HttpFoundation\Response(json_encode($messages));
    }

    private function updateSessionFilters($request) {

        $q = $request->get('q');
        $location = $request->get('location', false);
        $subcategoryname = $request->get('subcategoryname', false);
        $categoryname = $request->get('categoryname', false);
        $keywords = $request->get('keywords', false);
        $from_price = $request->get('from', false);
        $to_price = $request->get('to', false);
        $status = $request->get('status', false);
        $dir = $request->get('dir', false);
        $sort = $request->get('sort', false);
        $list_type = $request->get('list_type', false);

        if ($categoryname == "remove") {
            $this->removeFilter("categoryname");
        } elseif ($categoryname) {
            $this->saveFilter('categoryname', $categoryname);
        }

        if ($subcategoryname == "remove") {
            $this->removeFilter("subcategoryname");
        } elseif ($subcategoryname) {
            $this->saveFilter('subcategoryname', $subcategoryname);
        }

        if ($from_price == "remove") {
            $this->removeFilter("from");
        } elseif ($from_price) {
            $this->saveFilter('from', $from_price);
        }

        if ($q == "remove") {
            $this->removeFilter("q");
        } elseif ($q) {
            $this->saveFilter('q', $q);
        }

        if ($to_price == "remove") {
            $this->removeFilter("to");
        } elseif ($to_price) {
            $this->saveFilter('to', $to_price);
        }

        if ($location == "remove") {
            $this->removeFilter("location");
        } elseif ($location) {
            $this->saveFilter('location', $location);
        }

        if ($status == "remove") {
            $this->removeFilter("status");
        } elseif ($status) {
            $this->saveFilter('status', $status);
        }

        if ($keywords == "remove") {
            $this->removeFilter("keywords");
        } elseif ($keywords) {
            $this->saveFilter('keywords', $keywords);
        }

        if ($dir) {
            $this->saveFilter('dir', $dir);
        }
        if ($sort) {
            $this->saveFilter('sort', $sort);
        }
        if ($list_type) {
            $this->saveFilter('list_type', $list_type);
        }
    }

    private function suggests($text) {
        if($text=='')
            $text = "*";
        $search = $this->get('fos_elastica.index.search.anuncio');

        $elasticaQueryString = new \Elastica\Query\QueryString();
        $elasticaQueryString->setDefaultOperator('AND');
        $elasticaQueryString->setQuery($text);

        // Create the actual search object with some data.
        $elasticaQuery = new \Elastica\Query();
        $elasticaQuery->setQuery($elasticaQueryString);

        $suggest_title = new \Elastica\Suggest\Term('suggest_title', "title");
        $suggest_title->setSuggestMode("popular");

        $suggest_keywords = new \Elastica\Suggest\Term('suggest_keywords', "keywords");
        $suggest_keywords->setSuggestMode("popular");

        $suggest = new \Elastica\Suggest();


        $suggest->addSuggestion($suggest_title);
        $suggest->addSuggestion($suggest_keywords);

        $suggest->setGlobalText($text);


        $elasticaQuery->setSuggest($suggest);

        $elasticaResultSet = $search->search($elasticaQuery);

        $suggestions = array();

        if ($elasticaResultSet->countSuggests()) {
            $suggests = $elasticaResultSet->getSuggests();
            $suggestions = [];

            foreach ($suggests as $suggestion) {
                foreach ($suggestion as $value) {
                    foreach ($value['options'] as $options) {
                        $suggestions[] = $options['text'];
                    }
                }
            }
        }
        return $suggestions;
//        
//        echo "<pre>";
//        print_r($suggestions);
//        die;
    }

    /**
     * @Route("/search", name="search")
     * @Template()
     */
    public function searchAction() {
        $search = $this->get('fos_elastica.index.search.anuncio');
        $request = $this->getRequest();

        $ajax = $request->get('ajax', false);
        $page = $request->get('page', 1);

        $params = array();
        $this->updateSessionFilters($request);
        $session = $this->get('session');

        $original_q = $session->get('q');
        $location = $session->get('location');
        $categoryname = $session->get('categoryname');
        $subcategoryname = $session->get('subcategoryname');
        $keywords = $session->get('keywords');
        $from_price = $session->get('from');
        $to_price = $session->get('to');
        $status = $session->get('status');
        $dir = $session->get('dir');
        $sort = $session->get('sort');
        $list_type = $session->get('list_type');

        $q = $location . " " . $categoryname . " " . $subcategoryname . " " . $keywords . " " . $original_q;

        $elasticaQueryString = new \Elastica\Query\QueryString();
        //'And' or 'Or' default : 'Or'
        $elasticaQueryString->setDefaultOperator('AND');
        $elasticaQueryString->setQuery("$q*");

        // Create the actual search object with some data.
        $elasticaQuery = new \Elastica\Query();
        $elasticaQuery->setQuery($elasticaQueryString);


        $elasticaFilterAnd = new \Elastica\Filter\BoolAnd();

//        //FILTER------------------------------------------------------
        $ranges = array();
        if ($from_price) {
            $ranges['gte'] = $from_price;
        }
        if ($to_price) {
            $ranges['lte'] = $to_price;
        }
        if ($to_price || $from_price) {
            $filter_range = new \Elastica\Filter\Range();
            $filter_range->addField('price', $ranges);
            $elasticaFilterAnd->addFilter($filter_range);
        }

        //FILTER------------------------------------------------------

        if ($categoryname) {
            $params['categoryname'] = $categoryname;
        }
        if ($subcategoryname) {
            $params['subcategoryname'] = $subcategoryname;
        }
        if ($status) {
            $params['status'] = $status;
        }

        if ($location) {
            $params['location'] = $location;
        }
        if ($keywords) {
            $params['keywords'] = $keywords;
        } if (!$dir) {
            $dir = "desc";
        }
        if (!$sort) {
            $sort = "_score";
        }

        foreach ($params as $key => $value) {
            if ($value != null && $value != '') {
                $elasticaFilter = new \Elastica\Filter\Term();
                $elasticaFilter->setTerm($key, $value);
                $elasticaFilterAnd->addFilter($elasticaFilter);
            }
        }

        if ($location || $categoryname || $subcategoryname || $status || $keywords || $to_price || $from_price) {
            $elasticaQuery->setFilter($elasticaFilterAnd);
        }

        $elasticaQuery->setSort(array($sort => $dir));
        //------------------------------------------------------------
        $categoryFacet = new \Elastica\Facet\Terms('categoryname');
        $categoryFacet->setField('categoryname');
        $categoryFacet->setSize(10);

        $subcategoryFacet = new \Elastica\Facet\Terms('subcategoryname');
        $subcategoryFacet->setField('subcategoryname');
        $subcategoryFacet->setSize(20);

        $keywordFacet = new \Elastica\Facet\Terms('keywords');
        $keywordFacet->setField('keywords');
        $keywordFacet->setSize(10);

        $locationFacet = new \Elastica\Facet\Terms('location');
        $locationFacet->setField('location');
        $locationFacet->setSize(10);

        $statusFacet = new \Elastica\Facet\Terms('status');
        $statusFacet->setField('status');
        $statusFacet->setSize(4);


        // Add that facet to the search query object.
        $elasticaQuery->addFacet($categoryFacet);
        $elasticaQuery->addFacet($subcategoryFacet);
        $elasticaQuery->addFacet($keywordFacet);
        $elasticaQuery->addFacet($locationFacet);
        $elasticaQuery->addFacet($statusFacet);



        $limit = 10;
        $start = $page * $limit - $limit;

        $elasticaQuery->setLimit($limit);
        $elasticaQuery->setFrom($start);

        $elasticaResultSet = $search->search($elasticaQuery);
        $elasticaFacets = $elasticaResultSet->getFacets();

        $cant = $elasticaResultSet->getTotalHits();
        $time = $elasticaResultSet->getTotalTime();

        $repositoryManager = $this->get('fos_elastica.manager.mongodb');
        $repository = $repositoryManager->getRepository('TauenoBundle:Anuncio');

        $anuncios = $repository->find($elasticaQuery);


        $dm = $this->get('doctrine_mongodb')->getManager();
        $categories = $dm->getRepository("TauenoBundle:Category")->findAll();

        $template = "TauenoBundle:Front:search.html.twig";
        if ($ajax) {
            if (count($anuncios) == 0) {
                return new \Symfony\Component\HttpFoundation\Response("0 results");
            }
            $template = "TauenoBundle:Front:list.html.twig";
        }

        $suggestions = array();
        if (count($anuncios) == 0) {
            $suggestions = $this->suggests($original_q);
        }

        $facetnames = array('categoryname' => "Categorias", 'keywords' => "Marca, modelo", "subcategoryname" => "Subcategorias", "status" => "Estado", "location" => "Lugar");

        return $this->render($template, array("suggestions" => $suggestions, "facetnames" => $facetnames, "anuncios" => $anuncios, "categories" => $categories, "facets" => $elasticaFacets, "cant" => $cant, "time" => $time, "list_type" => $list_type, "params" => $params));
    }

    private function saveFilter($filter, $value) {
        $this->get('session')->set($filter, $value);
    }

    private function removeFilter($filter) {
        return $this->get('session')->set($filter, null);
    }

}
