<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{   
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($request->query->has('select-ot') and $request->query->get('select-ot') != '' ) {
            return $this->verOT($request);
        }

        return $this->render('AppBundle::index.html.twig', 
            array(
                'ot'            => null,
                'otDisponibles' => $this->obtenerObtenerOtsUsuario(),
                )
            );
    }

    public function verOT(Request $request)
    {
        $ot           = $request->query->get('select-ot');
        $datosEmpresa = $this->obtenerEmpresaPorOt($ot);

        $codEmpresa   = (array_key_exists('codigoEmpresa', $datosEmpresa))? $datosEmpresa['codigoEmpresa']: null;

        return $this->render('AppBundle::index.html.twig', 
            array(
                'otDisponibles'      => $this->obtenerObtenerOtsUsuario(),
                'detallePresupuesto' => $this->obtenerPresupuestoPorOt($ot),
                'minimoExigido'      => $this->obtenerMinimoExigidoPorOt($ot, $codEmpresa),
                'datosEmpresa'       => $datosEmpresa,
                'ot'                 => $ot,
                'data'               => array(),
                )
            );
    }

    /**
     * @Route("/pasarela", name="pasarela")
     */
    public function pasarelaAction()
    {
        $usuario = $this->get('request')->query->get('usuario');

        if ($this->get('request')->isMethod('POST')) {
            $usuario = $this->get('request')->request->get('usuario');
        }
        $base = $this->container->getParameter('application');

        $this->get('session')->set($base . '/usuario', $usuario);

        return $this->redirectToRoute('homepage');
    }

    private function obtenerObtenerOtsUsuario()
    {
        $base    = $this->container->getParameter('application');
        $usuario = $this->get('session')->get($base . '/usuario');

        return $this->get('app_conexion')->obtenerSucursalesOtActivasPorUsuario($usuario);
    }

    private function obtenerPresupuestoPorOt($ot)
    {
        $presupuesto = $this->get('app_conexion')->obtenerPresupuestoPorOt($ot);
        
        $ingresos        = array();
        $costosVariables = array();
        $costosFijos     = array();
        $margen          = 0;
        $totalGastos     = 0;

        foreach ($presupuesto as &$item) {
            $pu    = ($item[ 'C1' ] * $item[ 'T1' ]) + ($item[ 'C2' ] * $item[ 'T2' ]);
            $valor = $pu * $item[ 'Cantidad' ];

            if ($item[ 'Bloque' ] === 'Ingresos') {
                $ingresos[] = $item;
                $margen     = $margen + $valor;
                continue;
            }

            if ($item[ 'Bloque' ] === 'Costos variable') {
                $costosVariables[] = $item;
                $margen            = $margen - $valor;
                $totalGastos       = $totalGastos + $valor;
                continue;
            }

            if ($item[ 'Bloque' ] === 'Costos fijos') {
                $costosFijos[] = $item;
                $margen        = $margen - $valor;
                $totalGastos   = $totalGastos + $valor;
                continue;
            }
        }

        $arrReturn = array(
            'ingresos'        => $ingresos,
            'costosVariables' => $costosVariables,
            'costosFijos'     => $costosFijos,
            'margen'          => $margen,
            'totalGastos'     => $totalGastos,
            );

        return $arrReturn;
    }

    private function obtenerMinimoExigidoPorOt($ot, $codEmpresa)
    {
        return $this->get('app_conexion')->obtenerMinimoExigidoPorOt($ot, $codEmpresa);
    }

    private function obtenerEmpresaPorOt($ot)
    {
        return $this->get('app_conexion')->obtenerEmpresaPorOt($ot);
    }
}
