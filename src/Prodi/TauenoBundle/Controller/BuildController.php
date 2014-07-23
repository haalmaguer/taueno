<?php

namespace Prodi\TauenoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BuildController extends Controller {

    
    
    /**
     * @Route("/add_products/{limit}")
     * @Template()
     */
    public function addProductsAction($limit) {

        $dm = $this->get('doctrine_mongodb')->getManager();
        for ($i = 0; $i < $limit; $i++) {
            $anuncio = new \Prodi\TauenoBundle\Document\Anuncio();
            $anuncio->setPrice(rand(2, 10000));
            $anuncio->setEnabled(true);
            $anuncio->setDescription("Se vende producto...");
            $anuncio->setTitle($this->pickName());
            $anuncio->setLocation($this->pickLocation());
            $anuncio->setCategory($this->pickCategory());
            $anuncio->setPublishDate(new \DateTime());
            $anuncio->setStatus($this->pickStatus());
            $anuncio->setOwner($this->pickOwner());
            $anuncio->setKeywords($this->pickKeyword());

            $dm->persist($anuncio);
        }

        $dm->flush();
        return new \Symfony\Component\HttpFoundation\Response("terminado");
    }

    /**
     * @Route("/add_category")
     * @Template()
     */
    public function addCategoryAction() {

        $request = $this->getRequest();
        $name = $request->get("name");
        $color = $request->get("color");
        $category = new \Prodi\TauenoBundle\Document\Category();
        $category->setColor($color);
        $category->setName($name);
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($category);
        $dm->flush();

        die($category->getName());
    }
 
    /**
     * @Route("/test")
     * @Template()
     */
    public function testAction() {
        echo \Doctrine\ODM\MongoDB\Events::preFlush;
        die;
    }

  
    
    
    private function pickName() {
        $names = array("ventilador",
            "Teclado",
            "Joyas",
            "MP3",
            "Tv 29 pulgadas",
            "Tv 32 pulgadas",
            "DVD",
            "Contructor",
            "Series",
            "Pakete",
            "celular",
            "guitarra",
            "Pc de escritorio", 
            "laptop", 
            "zapatos", 
            "blusa", 
            "camisa", 
            "televisor", 
            "Plomero", 
            "Reparaciones", 
            "Chofer", 
            "Iphone", 
            "Mesa", 
            "Lada", 
            "Disco duro", 
            "Perro", 
            "Chofer", 
            "Gato", 
            "Pintura", 
            "Alqiler de habitacion", 
            "Memoria", 
            "Flash", 
            "RAM", 
            "Clases", 
            "Cursos de baile", 
            "RAM", 
            "Fiestas", 
            "Casas de alquiler", 
            "Apartamento 2 cuartos",
            "Celular",
            "Ropa de mujer",
            "Ropa de bebes",
            "Juguetes",
            "Rosseta Stone",
            "Monitor LCD",
            "Bocinas",
            "Kit motherboard",
            "Mochila",
            "Tenis",
            "zapatillas",
            "Relojes",
            "Cocinero",
            "chofer",
            "Almendron",
            "alquilo casa en guanabo",
            "Alquiler a cubanos",
            "Alquiler a extranjeros",
            "Ropa de hombre",
            "Telefonos",
            "Cerrajero",
            "Habitacion",
            "Piscina",
            "Pizza",
            );
        return $names[rand(0, count($names) - 1)];
    }

    private function pickKeyword() {
        $names = array("addidas", "nike", "Motorola", "samsumg", "Dell", "Puma", "Logitech", "LG", "Asus", "Haier", "Hp", "Toshiba", "24 horas", "8:00-3:00pm", "3cm", "23''");
        return $names[rand(0, count($names) - 1)];
    }

    private function pickLocation() {
        $names = array("Habana", "Matanzas", "Villa_Clara", "Marianao", "Varadero", "Cerro", "Vedado", "Habana_vieja", "Playa", "Plaza", "La_lisa", "Miramar");
        return $names[rand(0, count($names) - 1)];
    }

    private function pickStatus() {
        $names = array("Nuevo", "Usado", "Roto");
        return $names[rand(0, count($names) - 1)];
    }
   
    private function pickOwner() {
        $names = array("rachid@gmail.com","rali@gmail.com", "randy@gmail.com");
        return $names[rand(0, count($names) - 1)];
    }

    private function pickCategory() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $categories = $dm->getRepository("TauenoBundle:Category")->findAll();
        $categ_ids = array();
        foreach ($categories as $category) {
            $categ_ids[] = $category->getId();
        }
        return $dm->getRepository("TauenoBundle:Category")->find($categ_ids[rand(0, count($categ_ids) - 1)]);
    }
    /**
     * @Route("/add_categories")
     * @Template()
     */
    public function addcategoriesAction() {

// `taueno`.`categoria`
        $categoria = array(
            array('id' => '1', 'nombre' => 'Computadoras
', 'cant_anuncios' => '84', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '2', 'nombre' => 'Compra Venta
', 'cant_anuncios' => '139', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '3', 'nombre' => 'Servicios
', 'cant_anuncios' => '46', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '4', 'nombre' => 'Autos
', 'cant_anuncios' => '15', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '5', 'nombre' => 'Vivienda
', 'cant_anuncios' => '27', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '6', 'nombre' => 'Clases y Cursos
', 'cant_anuncios' => '21', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:27')
        );

// `taueno`.`sub_categoria`
        $sub_categoria = array(
            array('id' => '1', 'nombre' => '    PC de Escritorio
', 'categoria_id' => '1', 'cant_anuncios' => '10', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '2', 'nombre' => '    Laptop
', 'categoria_id' => '1', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '3', 'nombre' => '    Microprocesador
', 'categoria_id' => '1', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '4', 'nombre' => '    Monitor
', 'categoria_id' => '1', 'cant_anuncios' => '10', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '5', 'nombre' => '    Motherboard
', 'categoria_id' => '1', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '6', 'nombre' => '    Memoria RAM FLASH
', 'categoria_id' => '1', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '7', 'nombre' => '    Disco Duro Interno/Externo
', 'categoria_id' => '1', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-05-31 19:12:58'),
            array('id' => '8', 'nombre' => '    Chasis Fuente
', 'categoria_id' => '1', 'cant_anuncios' => '2', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-05-31 19:12:58'),
            array('id' => '9', 'nombre' => '    Tarjeta de Video
', 'categoria_id' => '1', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '10', 'nombre' => '    Tarjeta de Sonido Bocinas
', 'categoria_id' => '1', 'cant_anuncios' => '16', 'created_at' => '2011-05-31 19:11:04', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '11', 'nombre' => '    Quemador Lector DVD/CD
', 'categoria_id' => '1', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '12', 'nombre' => '    Backup UPS
', 'categoria_id' => '1', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-05-31 19:12:59'),
            array('id' => '13', 'nombre' => '    Impresora/Cartuchos
', 'categoria_id' => '1', 'cant_anuncios' => '4', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '14', 'nombre' => '    Modem Wifi Red
', 'categoria_id' => '1', 'cant_anuncios' => '13', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '15', 'nombre' => '    Webcam Microf Audífono
', 'categoria_id' => '1', 'cant_anuncios' => '1', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-05-31 19:12:56'),
            array('id' => '16', 'nombre' => '    Teclado Mouse
', 'categoria_id' => '1', 'cant_anuncios' => '2', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-05-31 19:13:02'),
            array('id' => '17', 'nombre' => '    Internet Email
', 'categoria_id' => '1', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '18', 'nombre' => '    CD DVD Virgen
', 'categoria_id' => '1', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '19', 'nombre' => '    Otros	
', 'categoria_id' => '1', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '20', 'nombre' => '    Célulares Líneas Accesorios
', 'categoria_id' => '2', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:23'),
            array('id' => '21', 'nombre' => '    Reproductor MP3 MP4 IPOD
', 'categoria_id' => '2', 'cant_anuncios' => '10', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '22', 'nombre' => '    Reproductor DVD VCD DVR
', 'categoria_id' => '2', 'cant_anuncios' => '4', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '23', 'nombre' => '    Televisor
', 'categoria_id' => '2', 'cant_anuncios' => '4', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:24'),
            array('id' => '24', 'nombre' => '    Cámara Foto Video
', 'categoria_id' => '2', 'cant_anuncios' => '36', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '25', 'nombre' => '    Aire Acondicionado
', 'categoria_id' => '2', 'cant_anuncios' => '11', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:24'),
            array('id' => '26', 'nombre' => '    Consola Videojuego Juegos
', 'categoria_id' => '2', 'cant_anuncios' => '8', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '27', 'nombre' => '    Satélite
', 'categoria_id' => '2', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:24'),
            array('id' => '28', 'nombre' => '    Electrodomésticos
', 'categoria_id' => '2', 'cant_anuncios' => '15', 'created_at' => '2011-05-31 19:11:05', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '29', 'nombre' => '    Muebles Decoración
', 'categoria_id' => '2', 'cant_anuncios' => '11', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '30', 'nombre' => '    Ropa/Zapato Accesorios
', 'categoria_id' => '2', 'cant_anuncios' => '4', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '31', 'nombre' => '    Intercambio Regalo
', 'categoria_id' => '2', 'cant_anuncios' => '12', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '32', 'nombre' => '    Divisas
', 'categoria_id' => '2', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '33', 'nombre' => '    Mascotas Animales
', 'categoria_id' => '2', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-05-31 19:12:54'),
            array('id' => '34', 'nombre' => '    Libros Revistas
', 'categoria_id' => '2', 'cant_anuncios' => '15', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '35', 'nombre' => '    Joyas Relojes
', 'categoria_id' => '2', 'cant_anuncios' => '1', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-05-31 19:12:43'),
            array('id' => '36', 'nombre' => '    Antiguedades Colección
', 'categoria_id' => '2', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '37', 'nombre' => '    Implementos Deportivos
', 'categoria_id' => '2', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '38', 'nombre' => '    Otros	
', 'categoria_id' => '2', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '39', 'nombre' => '    Informática/Programación
', 'categoria_id' => '3', 'cant_anuncios' => '8', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '40', 'nombre' => '    Películas/Series/Videos
', 'categoria_id' => '3', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-05-31 19:12:59'),
            array('id' => '41', 'nombre' => '    Limpieza/Doméstico
', 'categoria_id' => '3', 'cant_anuncios' => '14', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '42', 'nombre' => '    Foto/Video
', 'categoria_id' => '3', 'cant_anuncios' => NULL, 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-05-31 19:11:06'),
            array('id' => '43', 'nombre' => '    Construcción/Mantenimiento
', 'categoria_id' => '3', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '44', 'nombre' => '    Reparación Electrónica
', 'categoria_id' => '3', 'cant_anuncios' => '10', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '45', 'nombre' => '    Peluquería/Barbería/Belleza
', 'categoria_id' => '3', 'cant_anuncios' => '3', 'created_at' => '2011-05-31 19:11:06', 'updated_at' => '2011-05-31 19:12:54'),
            array('id' => '46', 'nombre' => '    Restaurantes/Gastronomía
', 'categoria_id' => '3', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '47', 'nombre' => '    Diseño/Decoración
', 'categoria_id' => '3', 'cant_anuncios' => NULL, 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:11:07'),
            array('id' => '48', 'nombre' => '    Música/Animación/Shows
', 'categoria_id' => '3', 'cant_anuncios' => '2', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:13:02'),
            array('id' => '49', 'nombre' => '    Relojero/Joyero
', 'categoria_id' => '3', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '50', 'nombre' => '    Gimnasio/Masaje/Entrenador
', 'categoria_id' => '3', 'cant_anuncios' => NULL, 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:11:07'),
            array('id' => '51', 'nombre' => '    Otros	
', 'categoria_id' => '3', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:29'),
            array('id' => '52', 'nombre' => '    Carros
', 'categoria_id' => '4', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '53', 'nombre' => '    Motos
', 'categoria_id' => '4', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '54', 'nombre' => '    Bicicletas
', 'categoria_id' => '4', 'cant_anuncios' => '4', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '55', 'nombre' => '    Piezas/Accesorios
', 'categoria_id' => '4', 'cant_anuncios' => '1', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:13:00'),
            array('id' => '56', 'nombre' => '    Alquiler
', 'categoria_id' => '4', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:23'),
            array('id' => '57', 'nombre' => '    Mecánico
', 'categoria_id' => '4', 'cant_anuncios' => NULL, 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:11:07'),
            array('id' => '58', 'nombre' => '    Otros	
', 'categoria_id' => '4', 'cant_anuncios' => '2', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-05-31 19:13:03'),
            array('id' => '59', 'nombre' => '    Compra/Venta
', 'categoria_id' => '5', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:23'),
            array('id' => '60', 'nombre' => '    Permuta
', 'categoria_id' => '5', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:07', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '61', 'nombre' => '    Alquiler a cubanos
', 'categoria_id' => '5', 'cant_anuncios' => '10', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '62', 'nombre' => '    Alquiler a extranjeros
', 'categoria_id' => '5', 'cant_anuncios' => '6', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:28'),
            array('id' => '63', 'nombre' => '    Casa en la playa	
', 'categoria_id' => '5', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:25'),
            array('id' => '64', 'nombre' => '    Idiomas
', 'categoria_id' => '6', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '65', 'nombre' => '    Música/Teatro/Danza
', 'categoria_id' => '6', 'cant_anuncios' => '7', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:27'),
            array('id' => '66', 'nombre' => '    Informática/Programación
', 'categoria_id' => '6', 'cant_anuncios' => '5', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:26'),
            array('id' => '67', 'nombre' => '    Repaso/Recuperación
', 'categoria_id' => '6', 'cant_anuncios' => '1', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-05-31 19:12:51'),
            array('id' => '68', 'nombre' => '    Otras clases particulares
', 'categoria_id' => '6', 'cant_anuncios' => '9', 'created_at' => '2011-05-31 19:11:08', 'updated_at' => '2011-06-03 22:59:26')
        );


        $dm = $this->get('doctrine_mongodb')->getManager();
        echo "<pre>";
        $cats = array();
        foreach ($categoria as $value) {
//            echo $categoria[$value['categoria_id']]['id'];
            $cats[$value['id']]=$value['nombre'];
        }
//        print_r($cats);die;
        foreach ($sub_categoria as $value) {
            $name = $value['nombre'];
            $family = $cats[$value['categoria_id']];
            $category = new \Prodi\TauenoBundle\Document\Category();
            $category->setName($name);
            $category->setType($family);
            $category->setColor("blue");
            $dm->persist($category);
        }
        
        $dm->flush();
        
        die("ya");
    }
    
    
    

}
