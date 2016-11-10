<?php

namespace AppBundle\Services;

use Psr\Log\LoggerInterface;

class ConexionWebService
{
    private $logger;

    /**
     * @var string
     */
    private $urlWebService = '';

    /**
     * @var nusoap_client | null
     */
    private $nuSopClient = null;

    public function __construct(LoggerInterface $logger, $urlWebService)
    {
        $this->logger        = $logger;
        $this->urlWebService = $urlWebService;
    }
    
    public function obtenerSucursalesOtActivasPorUsuario($usuario)
    {
        $nuSopClient = $this->obtenerConexionNuSoap();

        $arrDatosSoap            =  array();
        $arrDatosSoap['usuario'] = $usuario;

        $respuesta = $nuSopClient->call('SEGURIDAD_USUARIO_EMPRESA_SUCURSAL_OT_ACTIVAS', 
            $arrDatosSoap
            , 'http://tempuri.org'
            )
        ;

        if (!is_array($respuesta)) {
            return false;
        }

        if (!array_key_exists('SEGURIDAD_USUARIO_EMPRESA_SUCURSAL_OT_ACTIVASResult', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['SEGURIDAD_USUARIO_EMPRESA_SUCURSAL_OT_ACTIVASResult'];

        if (!array_key_exists('diffgram', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['diffgram'];

        if (!is_array($respuesta)) {
            return [];
        }

        $respuesta = $respuesta['NewDataSet']['Table'];

        $arrReturn = array();

        foreach ($respuesta as $ot) {
            $arrReturn[ $ot[ 'cod_curso_ot' ] ] = $ot[ 'cod_curso_ot' ];
        }

        return $arrReturn;
    }
    
    public function obtenerPresupuestoPorOt($codigoOt)
    {
        $nuSopClient = $this->obtenerConexionNuSoap();

        $arrDatosSoap       =  array();
        $arrDatosSoap['OT'] = $codigoOt;

        $respuesta = $nuSopClient->call('AR_PRESUPUESTOS_OT', 
            $arrDatosSoap
            , 'http://tempuri.org'
            )
        ;

        if (!is_array($respuesta)) {
            return false;
        }

        if (!array_key_exists('AR_PRESUPUESTOS_OTResult', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['AR_PRESUPUESTOS_OTResult'];

        if (!array_key_exists('diffgram', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['diffgram'];

        if (!is_array($respuesta)) {
            return [];
        }

        return $respuesta['NewDataSet']['Table'];
    }
    
    public function obtenerMinimoExigidoPorOt($codigoOt, $codEmpresa)
    {
        $nuSopClient = $this->obtenerConexionNuSoap();

        $arrDatosSoap                =  array();
        $arrDatosSoap['OT']          = $codigoOt;
        $arrDatosSoap['cod_empresa'] = $codEmpresa;

        $respuesta = $nuSopClient->call('MINIMO_EXIGIDO', 
            $arrDatosSoap
            , 'http://tempuri.org'
            )
        ;

        if (!is_array($respuesta)) {
            return false;
        }

        if (!array_key_exists('MINIMO_EXIGIDOResult', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['MINIMO_EXIGIDOResult'];

        if (!array_key_exists('diffgram', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['diffgram'];

        if (!is_array($respuesta)) {
            return [];
        }

        $respuesta = $respuesta['NewDataSet']['Table'];

        return array(
            'margen' => $respuesta['Margen'],
            'margenCostos' => $respuesta['Margen_costo'],
            );
    }

    public function obtenerEmpresaPorOt($codigoOt)
    {
        $nuSopClient = $this->obtenerConexionNuSoap();

        $arrDatosSoap       =  array();
        $arrDatosSoap['OT'] = $codigoOt;

        $respuesta = $nuSopClient->call('DATOS_EMPRESA_PRESUPUESTO', 
            $arrDatosSoap
            , 'http://tempuri.org'
            )
        ;

        if (!is_array($respuesta)) {
            return false;
        }

        if (!array_key_exists('DATOS_EMPRESA_PRESUPUESTOResult', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['DATOS_EMPRESA_PRESUPUESTOResult'];

        if (!array_key_exists('diffgram', $respuesta)) {
            return false;
        }

        $respuesta = $respuesta['diffgram'];

        if (!is_array($respuesta)) {
            return [];
        }

        $respuesta = $respuesta['NewDataSet']['Table'];

        return array(
            'codigoEmpresa'   => $respuesta['cod_empresa'],
            'nombreEmpresa'   => $respuesta['nombre_empresa'],
            'codigoProducto'  => $respuesta['cod_producto'],
            'nombreProducto'  => $respuesta['nombre_producto'],
            'fechaInicio'     => new \DateTime($respuesta['fecha_inicio']),
            'fechaTermino'    => new \DateTime($respuesta['fecha_termino']),
            'cantidadAlumnos' => $respuesta['n_alumnos'],
            'estado'          => $respuesta['estado'],
            );
    }

    private function obtenerConexionNuSoap()
    {
        if ($this->nuSopClient === null) {
            $this->nuSopClient = new \nusoap_client($this->urlWebService, true);
            $this->nuSopClient->soap_defencoding = 'UTF-8';
            $this->nuSopClient->decode_utf8 = false;
            $this->logger->info('Nueva Inicialización Cliente SOAP');
        }
        
        $this->logger->info('Nueva Conexión SOAP');

        if ($this->nuSopClient->getError()) {
            return false;
        }

        return $this->nuSopClient;
    }

}
