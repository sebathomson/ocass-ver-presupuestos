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
	 * @var string
	 */
	private $colorDefault = null;

	/**
	 * @var nusoap_client | null
	 */
	private $nuSopClient = null;

	public function __construct(LoggerInterface $logger, $urlWebService, $colorDefault)
	{
		$this->logger        = $logger;
		$this->urlWebService = $urlWebService;
		$this->colorDefault  = $colorDefault;
	}
	
	public function obtenerCursosDisponibles( $arrSucursales, $fechaInicio, $fechaTermino )
	{
		$arrReturn = [];

		foreach ($arrSucursales as $value) {
			$arrReturn = array_merge($arrReturn, $this->obtenerCursosOT($value['idEmpresa'], $value['idSucursal'], $fechaInicio, $fechaTermino));
		}

		return $arrReturn;
	}
	
	public function obtenerCursosOT($idEmpresa, $idSucursal, $fechaInicio, $fechaTermino)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Cod_Empresa']  = $idEmpresa;
		$arrDatosSoap['Cod_Sucursal'] = $idSucursal;
		$arrDatosSoap['Fecha_Inicio'] = $fechaInicio;
		$arrDatosSoap['Fecha_Fin']    = $fechaTermino;

		$respuesta = $nuSopClient->call('Cursos_OT', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('Cursos_OTResult', $respuesta)) {
			return false;
		}

		if (!array_key_exists('diffgram', $respuesta['Cursos_OTResult'])) {
			return false;
		}

		$respuesta = $respuesta['Cursos_OTResult']['diffgram'];

		if (!is_array($respuesta)) {
			return [];
		}

		$respuesta = $respuesta['NewDataSet']['Table'];

		if (array_key_exists('Monto_Facturado', $respuesta)) {
			$arr       = ['0' => $respuesta];
			$respuesta = $arr;
		}
		
		return $respuesta;
	}

	public function obtenerCursosDisponiblesReporte( $arrSucursales, $fechaInicio, $fechaTermino )
	{
		$arrReturn = [];

		foreach ($arrSucursales as $value) {
			$arrReturn = array_merge($arrReturn, $this->obtenerCursosOTReporte($value['idEmpresa'], $value['idSucursal'], $fechaInicio, $fechaTermino));
		}

		return $arrReturn;
	}
	
	public function obtenerCursosOTReporte($idEmpresa, $idSucursal, $fechaInicio, $fechaTermino)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Cod_Empresa']  = $idEmpresa;
		$arrDatosSoap['Cod_Sucursal'] = $idSucursal;
		$arrDatosSoap['Fecha_Inicio'] = $fechaInicio;
		$arrDatosSoap['Fecha_Fin']    = $fechaTermino;

		$respuesta = $nuSopClient->call('Cursos_OT_PERIODOS', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('Cursos_OT_PERIODOSResult', $respuesta)) {
			return false;
		}

		if (!array_key_exists('diffgram', $respuesta['Cursos_OT_PERIODOSResult'])) {
			return false;
		}

		$respuesta = $respuesta['Cursos_OT_PERIODOSResult']['diffgram'];

		if (!is_array($respuesta)) {
			return [];
		}

		$respuesta = $respuesta['NewDataSet']['Table'];

		if (array_key_exists('Monto_Facturado', $respuesta)) {
			$arr       = ['0' => $respuesta];
			$respuesta = $arr;
		}
		
		return $respuesta;
	}

	public function obtenerComisionSucursales( $arrSucursales, $fechaInicio, $fechaTermino )
	{
		$comisionSucursal = 0;

		foreach ($arrSucursales as $value) {
			$comisionSucursal += $this->obtenerComisionesPanelControl($value['idEmpresa'], $value['idSucursal'], $fechaInicio, $fechaTermino);
		}

		return number_format($comisionSucursal, 0, ',', '.');
	}

	public function obtenerComisionesPanelControl($idEmpresa, $idSucursal, $fechaInicio, $fechaTermino)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Cod_Empresa']  = $idEmpresa;
		$arrDatosSoap['Centro_costo'] = $idSucursal;
		$arrDatosSoap['Fecha_Inicio'] = $fechaInicio;
		$arrDatosSoap['Fecha_Fin']    = $fechaTermino;

		$respuesta = $nuSopClient->call('COMISIONES_PANEL_CONTROL', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('COMISIONES_PANEL_CONTROLResult', $respuesta)) {
			return false;
		}

		if (!array_key_exists('diffgram', $respuesta['COMISIONES_PANEL_CONTROLResult'])) {
			return false;
		}

		$respuesta = $respuesta['COMISIONES_PANEL_CONTROLResult']['diffgram'];

		if (!is_array($respuesta)) {
			return [];
		}

		$respuesta = $respuesta['NewDataSet']['Table'];

		if (!array_key_exists('comision', $respuesta)) {
			return 0;
		}
		
		return $respuesta[ 'comision' ];
	}

	public function obtenerListadoEmpresasDeUsuario($usuario)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap            =  array();
		$arrDatosSoap['usuario'] = $usuario;

		$respuesta = $nuSopClient->call('Lista_Permisos_Empresa_usuario', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('Lista_Permisos_Empresa_usuarioResult', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['Lista_Permisos_Empresa_usuarioResult'];

		if (!array_key_exists('diffgram', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['diffgram'];

		if (!is_array($respuesta)) {
			return [];
		}

		$respuesta = $respuesta['NewDataSet']['Table'];

		if (array_key_exists('EXU_IDEMPRESA', $respuesta)) {
			$arr       = ['0' => $respuesta];
			$respuesta = $arr;
		}

		$arrEmpresas = [];

		foreach ($respuesta as $value) {
			$arrValue =[];
			$arrValue['idEmpresa']     = $value['EXU_IDEMPRESA'];
			$arrValue['nombreEmpresa'] = $this->obtenerNombreEmpresa( $value['EXU_IDEMPRESA'] );

			$arrEmpresas[$value['EXU_IDEMPRESA']] = $arrValue;
		}

		return $arrEmpresas;
	}

	public function obtenerListadoSucursalesDeUsuario($usuario, $arrEmpresas)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['usuario'] = $usuario;


		$respuesta = $nuSopClient->call('PERMISO_USUARIOS_SUCURSALES', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('PERMISO_USUARIOS_SUCURSALESResult', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['PERMISO_USUARIOS_SUCURSALESResult'];

		if (!array_key_exists('diffgram', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['diffgram'];

		if (!is_array($respuesta)) {
			return [];
		}

		// Si tiene el campo 'valor', quiere decir que es *.
		if (array_key_exists('valor', $respuesta['NewDataSet']['Table'])) {
			$valor = $respuesta['NewDataSet']['Table']['valor'];

			$arrSucursales = [];

			foreach ($arrEmpresas as $empresa) {
				$nombresSucursales = $this->obtenerNombreSucursal( $valor, $empresa[ 'idEmpresa' ] );

				foreach ($nombresSucursales as $sucursal) {
					$arrValue                    = [];

					$arrValue[ 'idEmpresa' ]      = $empresa[ 'idEmpresa' ];
					$arrValue[ 'nombreEmpresa' ]  = $empresa[ 'nombreEmpresa' ];
					$arrValue[ 'idSucursal' ]     = $sucursal[ 'idSucursal' ];
					$arrValue[ 'nombreSucursal' ] = $sucursal[ 'nombreSucursal' ];

					$arrSucursales[] = $arrValue;
				}
			}

			return $arrSucursales;
		}

		$respuesta     = $respuesta['NewDataSet']['Table'];

		$arrSucursales = [];

		foreach ($respuesta as $value) {
			$valor = $value['valor'];

			foreach ($arrEmpresas as $empresa) {
				$nombresSucursales = $this->obtenerNombreSucursal( $valor, $empresa[ 'idEmpresa' ] );

				foreach ($nombresSucursales as $sucursal) {
					$arrValue                    = [];

					$arrValue[ 'idEmpresa' ]      = $empresa[ 'idEmpresa' ];
					$arrValue[ 'nombreEmpresa' ]  = $empresa[ 'nombreEmpresa' ];
					$arrValue[ 'idSucursal' ]     = $sucursal[ 'idSucursal' ];
					$arrValue[ 'nombreSucursal' ] = $sucursal[ 'nombreSucursal' ];

					$arrSucursales[] = $arrValue;
				}
			}
		}

		return $arrSucursales;
	}

	public function obtenerNombreEmpresa($idEmpresa)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Codigo'] = $idEmpresa;

		$respuesta = $nuSopClient->call('NOMBRE_EMPRESA', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('NOMBRE_EMPRESAResult', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['NOMBRE_EMPRESAResult'];

		if (!array_key_exists('diffgram', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['diffgram'];

		if (!is_array($respuesta)) {
			return '';
		}

		return $respuesta['NewDataSet']['Table']['NOMBRE'];
	}

	public function obtenerNombreSucursal($idSucursal, $idEmpresa)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Cod_sucursal'] = $idSucursal;
		$arrDatosSoap['cod_empresa']  = $idEmpresa;

		$respuesta = $nuSopClient->call('NOMBRE_SUCURSALES', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('NOMBRE_SUCURSALESResult', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['NOMBRE_SUCURSALESResult'];

		if (!array_key_exists('diffgram', $respuesta)) {
			return false;
		}

		$respuesta = $respuesta['diffgram'];

		if (!is_array($respuesta)) {
			return '';
		}

		$respuesta = $respuesta['NewDataSet']['Table'];

		if (array_key_exists('cod_centro_costo', $respuesta)) {
			$arr       = ['0' => $respuesta];
			$respuesta = $arr;
		}

		$arrSucursales = [];

		foreach ($respuesta as $sucursal) {
			$arrValue = [];

			$arrValue['idSucursal']     = $sucursal[ 'cod_centro_costo' ];
			$arrValue['nombreSucursal'] = $sucursal[ 'descripcion_centro_costo' ];

			$arrSucursales[] = $arrValue;
		}

		return $arrSucursales;
	}

	public function obtenerColorCurso( $arrCursosDisponibles )
	{
		$arrColores = [];

		foreach ($arrCursosDisponibles as &$curso) {
			$tipoCurso   = str_replace('_', '', $curso[ 'Tipo_Curso' ]);
			$tipoCurso   = strtolower($tipoCurso);
			$keyTemporal = $curso[ 'bloque' ] . $tipoCurso . $curso[ 'rentabilidad' ];

			if (array_key_exists($keyTemporal, $arrColores)) {
				$color = $arrColores[ $keyTemporal ];
			} else {
				$color = $this->obtenerColorPanelControl($curso[ 'bloque' ], $tipoCurso, $curso[ 'rentabilidad' ], $curso[ 'Cod_ot' ]);
				$arrColores[ $keyTemporal ] = $color;
			}

			$curso[ 'color_vehiculo' ] = $color;
		}

		return $arrCursosDisponibles;
	}

	public function obtenerColorPanelControl($bloque, $tipoCurso, $rentabilidad, $cursoOt)
	{
		$nuSopClient = $this->obtenerConexionNuSoap();

		$arrDatosSoap =  array();

		$arrDatosSoap['Bloque']     = $bloque;
		$arrDatosSoap['porcentaje'] = $rentabilidad;
		$arrDatosSoap['tipo_curso'] = $tipoCurso;
		$arrDatosSoap['Cod_ot'] = $cursoOt;

		$respuesta = $nuSopClient->call('COLOR_PANEL_CONTROL', 
			$arrDatosSoap
			, 'http://tempuri.org'
			)
		;

		if (!is_array($respuesta)) {
			return false;
		}

		if (!array_key_exists('COLOR_PANEL_CONTROLResult', $respuesta)) {
			return false;
		}

		if (!array_key_exists('diffgram', $respuesta['COLOR_PANEL_CONTROLResult'])) {
			return false;
		}

		$respuesta = $respuesta['COLOR_PANEL_CONTROLResult']['diffgram'];

		if (!is_array($respuesta)) {
			return $this->colorDefault;
		}
		
		return $respuesta['NewDataSet']['Table']['COD_COLOR'];
	}

	private function obtenerConexionNuSoap()
	{
		if ($this->nuSopClient === null) {
			$this->nuSopClient = new \nusoap_client($this->urlWebService, true);
			$this->logger->info('Nueva Inicialización Cliente SOAP');
		}
		
		$this->logger->info('Nueva Conexión SOAP');

		if ($this->nuSopClient->getError()) {
			return false;
		}

		return $this->nuSopClient;
	}

}
