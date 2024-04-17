<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Producto;
use App\Form\ProductoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{

    #[Route('/producto/{id}', name: "showProduct")]
    public function showProducto(EntityManagerInterface $doctrine, $id)
    {
       $repository = $doctrine->getRepository(Producto::class);
        $producto = $repository->find($id);

        return $this->render('producto/showProducto.html.twig', ['producto' => $producto]);
    }


    #[Route('/productos', name:"listProductos")]
    public function listProductos(EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(Producto::class);

        $productos = $repository->findAll();

        return $this->render('producto/listProductos.html.twig', ['productos' => $productos]);
    }

     #[Route('/insert/producto')]
    public function insertProducto(EntityManagerInterface $doctrine)
    {
        $producto = new Producto();
        $producto -> setNombre('Cenicero');
        $producto-> setDescripcion('Cenicero de resina epoxy color verde con serpiente');
        $producto->setImagen('https://i.etsystatic.com/35346901/r/il/8f0577/5734735890/il_794xN.5734735890_2cmj.jpg');
        $producto->setPrecio(20);
        

        $producto2 = new Producto();
        $producto2 -> setNombre('Bandeja');
        $producto2-> setDescripcion('Bandeja de resina epoxy color rosa con flores');
        $producto2-> setImagen('https://i.etsystatic.com/35650270/r/il/f0f096/4845754342/il_794xN.4845754342_pzb2.jpg');
        $producto2-> setPrecio(25);
      


        $producto3 = new Producto();
        $producto3 -> setNombre('Posavasos');
        $producto3-> setDescripcion('Posavasos de resina epoxy color azul');
        $producto3-> setImagen('https://i.etsystatic.com/22627138/r/il/018097/2551439558/il_570xN.2551439558_ngg9.jpg');
        $producto3-> setPrecio(30);
        


        $producto4 = new Producto();
        $producto4 -> setNombre('Prendedores');
        $producto4-> setDescripcion('Prendedores de pelo de resina epoxy flores');
        $producto4-> setImagen('https://i.etsystatic.com/22504984/r/il/5a74f3/4257321820/il_600x600.4257321820_r8js.jpg');
        $producto4-> setPrecio(15);
        $categorias = new Categorias();
        $categorias-> setNombre('Hogar');
        $doctrine->persist($producto);
        $categorias2 = new Categorias();
        $categorias2-> setNombre('Belleza');
        $doctrine->persist($producto2);
        $categorias3 = new Categorias();
        $categorias3-> setNombre('Cocina');
        $producto->addCategoria($categorias);
        $producto->addCategoria($categorias2);
        $producto->addCategoria($categorias3);
        $doctrine->persist($categorias);
        $doctrine->persist($categorias2);
        $doctrine->persist($categorias3);
        $doctrine->persist($producto3);
        $doctrine->persist($producto4);
        $doctrine->flush();
        return new Response('Producto añadido con exito!');
    }

   #[Route('/new/producto', name: "newProducto")]
     public function newProducto(EntityManagerInterface $doctrine, Request $request)
    {
        $form = $this->createForm(ProductoType::class);
        $form->handleRequest($request);
        if ($form ->isSubmitted() && $form ->isValid()) {
            $producto = $form->getData();
            $doctrine->persist($producto);
            $doctrine->flush();
            $this->addFlash('exito','Producto guardado correctamente');
            return $this->redirectToRoute('listProductos');

        }

        return $this->render('producto/newProducto.html.twig', ['productoForm' => $form]);
    }

    #[Route('/edit/producto{}', name: "editProducto")]
     public function editProducto($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repository = $doctrine->getRepository(Producto::class);
        $producto = $repository->find($id);

        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);
        if ($form ->isSubmitted() && $form ->isValid()) {
            $producto = $form->getData();
            $doctrine->persist($producto);
            $doctrine->flush();
            $this->addFlash('exito','Producto guardado correctamente');
            return $this->redirectToRoute('listProductos');

        }

        return $this->render('producto/newProducto.html.twig', ['productoForm' => $form]);
    }

      #[Route('/delete/producto{}', name: "deleteProducto")]
     public function deleteProducto($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repository = $doctrine->getRepository(Producto::class);
        $producto = $repository->find($id);
        $doctrine->remove($producto);
        $doctrine->flush();
        return $this->redirectToRoute('listProductos');
    }


}
