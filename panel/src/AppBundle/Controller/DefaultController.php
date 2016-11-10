<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/pasarela", name="pasarela")
     */
    public function pasarelaAction()
    {
        $usuario = $this->get('request')->query->get('usuario');

        if ($this->get('request')->isMethod('POST')) {
            $usuario = $this->get('request')->request->get('usuario');

            $this->get('session')->set('idEmpresa', $this->get('request')->request->get('idEmpresa'));
            $this->get('session')->set('idSucursal', $this->get('request')->request->get('idSucursal'));
        }

        $hoy         = (new \DateTime())->modify('first day of this month');
        $inicio      = $hoy->modify('- 6 months');
        $fin         = (new \DateTime())->modify('+ 2 months');
        $fin         = $fin->modify('last day of this month');

        $this->get('session')->set('nombreUsuario', $usuario);
        $this->get('session')->set('fechaInicio', $inicio->format('m/d/Y'));
        $this->get('session')->set('fechaTermino', $fin->format('m/d/Y'));

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $conexionWebservice   = $this->get('monitor.conexion_webservice');
        $utilsService         = $this->get('monitor.utils');
        
        $usuario              = $this->get('session')->get('nombreUsuario');
        $fechaInicio          = $this->get('session')->get('fechaInicio');
        $fechaTermino         = $this->get('session')->get('fechaTermino');
        
        $arrEmpresas          = $conexionWebservice->obtenerListadoEmpresasDeUsuario( $usuario );
        $arrSucursales        = $conexionWebservice->obtenerListadoSucursalesDeUsuario( $usuario, $arrEmpresas );
	
        $arrSucursales        = $utilsService->filtrarSelectSucursales($arrSucursales);
        
        $arrCursosDisponibles = $conexionWebservice->obtenerCursosDisponibles( $arrSucursales, $fechaInicio, $fechaTermino );
        
        $arrSucursales        = $utilsService->filtrarSucursalesConCurso($arrSucursales, $arrCursosDisponibles);

        $arrTiposCurso        = $utilsService->obtenerTiposCurso();
        $arrMeses             = $utilsService->obtenerMesesEntreFechas( $fechaInicio, $fechaTermino );
       
        $arrCursosDisponibles = $utilsService->obtenerTipoCursoDeCursos($arrCursosDisponibles);
        $arrCursosDisponibles = $utilsService->obtenerFechasCurso($arrCursosDisponibles);
        $arrCursosDisponibles = $utilsService->obtenerRentabilidad($arrCursosDisponibles);
        $arrCursosDisponibles = $utilsService->obtenerBloque($arrCursosDisponibles, $arrMeses);

        $arrSucursales        = $utilsService->obtenerTiposCursoDeSucursales($arrSucursales, $arrCursosDisponibles);

        $arrCursosDisponibles = $conexionWebservice->obtenerColorCurso( $arrCursosDisponibles );

        $arrCursosDisponibles = $utilsService->formatearNumeros($arrCursosDisponibles);
        $arrCursosDisponibles = $utilsService->ordenarCursos($arrCursosDisponibles);

        foreach ($arrMeses as $key => $mes) {
            if ($mes['esPasado'] === false) {
                $iniciomesanio = $key;
                $diasmesactual = $mes[ 'numdias' ];
                break;
            }
        }

        return $this->render('AppBundle:Default:index.html.twig', [
            'tiposCurso'    => $arrTiposCurso,
            'cursos'        => $arrCursosDisponibles,
            'iniciomesanio' => $iniciomesanio,
            'diasmesactual' => $diasmesactual,
            'sucursales'    => $arrSucursales,
            'meses'         => $arrMeses,
            'diaActual'     => $utilsService->obtenerDiaActual(),
            ]);
    }

    /**
     * @Route("/obtenerSelectSucursales", name="obtenerSelectSucursales")
     */
    public function obtenerSelectSucursalesAction()
    {
        $conexionWebservice = $this->get('monitor.conexion_webservice');

        $usuario            = $this->get('session')->get('nombreUsuario');

        $arrEmpresas        = $conexionWebservice->obtenerListadoEmpresasDeUsuario( $usuario );
        $arrSucursales      = $conexionWebservice->obtenerListadoSucursalesDeUsuario( $usuario, $arrEmpresas );

        return $this->render('AppBundle:Default:selectSucursales.html.twig', [
            'usuario'    => $usuario,
            'empresas'   => $arrEmpresas,
            'sucursales' => $arrSucursales,
            'idEmpresa'  => $this->container->get('session')->get('idEmpresa', 'todas'),
            'idSucursal' => $this->container->get('session')->get('idSucursal', 'todas'),
            ]);
    }

    /**
     * @Route("/obtenerVistaReporte", name="obtenerVistaReporte")
     */
    public function obtenerVistaReporteAction()
    {
        $usuario              = $this->get('session')->get('nombreUsuario');
        $idEmpresa            = $this->container->get('session')->get('idEmpresa', 'todas');
        $idSucursal           = $this->container->get('session')->get('idSucursal', 'todas');
        
        $inicio               = (new \DateTime())->modify('first day of this month');
        $fin                  = (new \DateTime())->modify('last day of this month');

        $inicioAnterior       = (new \DateTime())->modify('first day of this month');
        $inicioAnterior       = $inicioAnterior->modify('-1 year');
        $finAnterior          = (new \DateTime())->modify('last day of this month');
        $finAnterior          = $finAnterior->modify('-1 year');

        $arrOpciones          = [];

        $arrOpciones[ 'usuario' ]        = $usuario;
        $arrOpciones[ 'idEmpresa' ]      = $idEmpresa;
        $arrOpciones[ 'idSucursal' ]     = $idSucursal;
        $arrOpciones[ 'inicio' ]         = $inicio->format('m/d/Y');
        $arrOpciones[ 'fin' ]            = $fin->format('m/d/Y');
        $arrOpciones[ 'inicioAnterior' ] = $inicioAnterior->format('m/d/Y');
        $arrOpciones[ 'finAnterior' ]    = $finAnterior->format('m/d/Y');

        $arrDatosReporte = $this->obtenerDatosVistaReporte($arrOpciones);

        return $this->render('AppBundle:Default:vistaReporte.html.twig', $arrDatosReporte);
    }

    /**
     * @Route("/obtenerVistaReporteFiltro", name="obtenerVistaReporteFiltro")
     */
    public function obtenerVistaReporteFiltroAction(Request $request)
    {
        $usuario              = $request->request->get('usuario');
        $idEmpresa            = $request->request->get('idEmpresa');
        $idSucursal           = $request->request->get('idSucursal');
        $inicioRequest        = $request->request->get('inicio');
        $finRequest           = $request->request->get('fin');
        
        $inicio               = (new \DateTime( date($inicioRequest) ))->modify('first day of this month');
        $fin                  = (new \DateTime( date($finRequest) ))->modify('last day of this month');

        $inicioAnterior       = (new \DateTime( date($inicioRequest) ))->modify('first day of this month');
        $inicioAnterior       = $inicioAnterior->modify('-1 year');
        $finAnterior          = (new \DateTime( date($finRequest) ))->modify('last day of this month');
        $finAnterior          = $finAnterior->modify('-1 year');

        $arrOpciones          = [];

        $arrOpciones[ 'usuario' ]        = $usuario;
        $arrOpciones[ 'idEmpresa' ]      = $idEmpresa;
        $arrOpciones[ 'idSucursal' ]     = $idSucursal;
        $arrOpciones[ 'inicio' ]         = $inicio->format('m/d/Y');
        $arrOpciones[ 'fin' ]            = $fin->format('m/d/Y');
        $arrOpciones[ 'inicioAnterior' ] = $inicioAnterior->format('m/d/Y');
        $arrOpciones[ 'finAnterior' ]    = $finAnterior->format('m/d/Y');

        $arrDatosReporte = $this->obtenerDatosVistaReporte($arrOpciones);

        return $this->render('AppBundle:Default:_reporte.html.twig', $arrDatosReporte);
    }

    private function obtenerDatosVistaReporte($arrOpciones)
    {
        $arrReturn                 = [];
        $usuario                   = $arrOpciones[ 'usuario' ];
        $arrReturn[ 'usuario' ]    = $usuario;
        $inicio                    = $arrOpciones[ 'inicio' ];
        $arrReturn[ 'inicio' ]     = $inicio;
        $fin                       = $arrOpciones[ 'fin' ];
        $arrReturn[ 'fin' ]        = $fin;
        $inicioAnterior            = $arrOpciones[ 'inicioAnterior' ];
        $finAnterior               = $arrOpciones[ 'finAnterior' ];
        $idEmpresa                 = $arrOpciones[ 'idEmpresa' ];
        $arrReturn[ 'idEmpresa' ]  = $idEmpresa;
        $idSucursal                = $arrOpciones[ 'idSucursal' ];
        $arrReturn[ 'idSucursal' ] = $idSucursal;

        $conexionWebservice = $this->get('monitor.conexion_webservice');
        $utilsService       = $this->get('monitor.utils');

        $arrEmpresas               = $conexionWebservice->obtenerListadoEmpresasDeUsuario( $usuario );
        $arrReturn[ 'empresas' ]   = $arrEmpresas;
        $arrSucursales             = $conexionWebservice->obtenerListadoSucursalesDeUsuario( $usuario, $arrEmpresas );
        $arrSucursales             = $utilsService->filtrarSelectSucursalesReporte($arrSucursales, $idEmpresa, $idSucursal);
        $arrReturn[ 'sucursales' ] = $arrSucursales;
        
        $arrCursosReporteActual   = $conexionWebservice->obtenerCursosDisponiblesReporte( $arrSucursales, $inicio, $fin );
        $arrCursosReporteAnterior = $conexionWebservice->obtenerCursosDisponiblesReporte( $arrSucursales, $inicioAnterior, $finAnterior );

        $comision[ 'actual' ]    = $conexionWebservice->obtenerComisionSucursales( $arrSucursales, $inicio, $fin );
        $comision[ 'anterior' ]  = $conexionWebservice->obtenerComisionSucursales( $arrSucursales, $inicioAnterior, $finAnterior );
        $arrReturn[ 'comision' ] = $comision;

        $facturacion[ 'actual' ]    = $utilsService->obtenerSumaFacturacion( $arrCursosReporteActual );
        $facturacion[ 'anterior' ]  = $utilsService->obtenerSumaFacturacion( $arrCursosReporteAnterior );
        $arrReturn[ 'facturacion' ] = $facturacion;

        $pagado[ 'actual' ]    = $utilsService->obtenerSumaPagado( $arrCursosReporteActual );
        $pagado[ 'anterior' ]  = $utilsService->obtenerSumaPagado( $arrCursosReporteAnterior );
        $arrReturn[ 'pagado' ] = $pagado;

        $arrTiposCurso = $utilsService->obtenerTiposCurso();
        $arrReturn[ 'arrTiposCurso' ] = $arrTiposCurso;

        $alumnosPorCurso[ 'actual' ]    = $utilsService->obtenerSumaAlumnosPorCurso( $arrCursosReporteActual );
        $alumnosPorCurso[ 'anterior' ]  = $utilsService->obtenerSumaAlumnosPorCurso( $arrCursosReporteAnterior );
        $arrReturn[ 'alumnosPorCurso' ] = $alumnosPorCurso;

        $arrRelatores                = $utilsService->obtenerRelatores($arrCursosReporteActual, $arrCursosReporteAnterior);
        $arrReturn[ 'arrRelatores' ] = $arrRelatores;

        $alumnosPorRelator[ 'actual' ]    = $utilsService->obtenerSumaAlumnosPorRelator( $arrCursosReporteActual, $arrRelatores );
        $alumnosPorRelator[ 'anterior' ]  = $utilsService->obtenerSumaAlumnosPorRelator( $arrCursosReporteAnterior, $arrRelatores );
        $arrReturn[ 'alumnosPorRelator' ] = $alumnosPorRelator;

        return $arrReturn;
    }
}
