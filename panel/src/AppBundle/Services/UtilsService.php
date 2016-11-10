<?php

namespace AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class UtilsService
{
	/**
	 * @var array
	 */
	public $tiposVehiculos = [
		'A2_A3' => 'clase_a2_a3.png',
		'A4_A5' => 'clase_a4_a5.png',
		'CA3'   => 'clase_ca3.png',
		'CA5'   => 'clase_ca5.png',
		'B'     => 'clase_b.png',
		'D'     => 'clase_d.png',
	];

	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function obtenerTiposCurso()
	{
		return $this->tiposVehiculos;
	}

	public function obtenerTiposCursoDeSucursales($arrSucursales, $arrCursosDisponibles)
	{
		foreach ($arrSucursales as &$sucursal) {
			if (!array_key_exists('tiposCurso', $sucursal)) {
				$sucursal[ 'tiposCurso' ] = [];
			}

			foreach ($arrCursosDisponibles as $curso) {
				if ($sucursal['idEmpresa'] != $curso['Cod_empresa']) {
					continue;
				}

				if ($sucursal['idSucursal'] != $curso['Cod_sucursal']) {
					continue;
				}

				$tipoCurso = strtoupper(str_replace(' ', '_', $curso[ 'Tipo_Curso' ]));
				
				$sucursal[ 'tiposCurso' ][ $tipoCurso ] = $tipoCurso;
			}
		}

		return $arrSucursales;
	}

	public function obtenerTipoCursoDeCursos($arrCursosDisponibles)
	{
		foreach ($arrCursosDisponibles as $key => &$value) {
			$value[ 'Tipo_Curso' ]   = str_replace(' ', '_', $value[ 'Tipo_Curso' ]);
			$value[ 'imagen_curso' ] = $this->tiposVehiculos[ $value[ 'Tipo_Curso' ] ];
		}

		return $arrCursosDisponibles;
	}

	public function ordenarCursos($arrCursosDisponibles)
	{
		$arrOrdenPorFecha = [];

		foreach ($arrCursosDisponibles as $key => $value) {
			$empresa   = $value[ 'Cod_empresa' ];
			$sucursal  = $value[ 'Cod_sucursal' ];
			$tipoCurso = $value[ 'Tipo_Curso' ];
			$bloque    = $value[ 'bloque' ];
			$fecha     = $value[ 'o_Fecha_Inicio' ];

			$curso = [];

			$curso[ 'fecha' ] = $fecha->getTimestamp();
			$curso[ 'key' ]   = $key;
			$curso[ 'curso' ] = $value;

			$arrOrdenPorFecha[ $empresa . $sucursal . $tipoCurso . $bloque ][] = $curso;
		}

		$arrCursosYaOrdenados = [];

		foreach ($arrOrdenPorFecha as $cursos) {
			$cursosOrdenados = $this->ordenarCursosDeUnTipoCurso($cursos);

			ksort($cursosOrdenados);

			foreach ($cursosOrdenados as $curso) {
				$arrCursosYaOrdenados[] = $curso[ 'curso' ];
			}
		}

		return $arrCursosYaOrdenados;
	}

	public function formatearNumeros($arrCursosDisponibles)
	{
		foreach ($arrCursosDisponibles as &$value) {
			$value[ 'Porcentaje_Utilidad_nominal' ] = $value[ 'Porcentaje_Utilidad_nominal' ] . '%';
			$value[ 'Porcentaje_Utilidad_real' ]    = $value[ 'Porcentaje_Utilidad_real' ] . '%';
			$value[ 'Porcentaje_Cap_Alumnos' ]      = $value[ 'Porcentaje_Cap_Alumnos' ] . '%';
			$value[ 'Monto_Facturado' ]             = number_format($value[ 'Monto_Facturado' ], 0, ',', '.');
			$value[ 'Monto_Pagado' ]                = number_format($value[ 'Monto_Pagado' ], 0, ',', '.');
			$value[ 'Costo_OT_devengado' ]          = number_format($value[ 'Costo_OT_devengado' ], 0, ',', '.');
			$value[ 'Costo_OT_real' ]               = number_format($value[ 'Costo_OT_real' ], 0, ',', '.');
			$value[ 'Utilidad_ot_nominal' ]         = number_format($value[ 'Utilidad_ot_nominal' ], 0, ',', '.');
			$value[ 'Utilidad_ot_real' ]            = number_format($value[ 'Utilidad_ot_real' ], 0, ',', '.');
		}

		return $arrCursosDisponibles;
	}

	public function obtenerRentabilidad($arrCursosDisponibles)
	{
		foreach ($arrCursosDisponibles as &$value) {
			$value['rentabilidad'] = $value[ 'Porcentaje_Utilidad_real' ];
		}

		return $arrCursosDisponibles;
	}

	public function obtenerBloque($arrCursosDisponibles, $arrMeses)
	{
		foreach ($arrCursosDisponibles as &$value) {
			$bloque            = $arrMeses[ $value[ 'inicio_mes_anio' ] ][ 'bloque' ];
			$value[ 'bloque' ] = $bloque;
		}

		return $arrCursosDisponibles;
	}

	public function obtenerFechasCurso($arrCursosDisponibles)
	{
		foreach ($arrCursosDisponibles as &$value) {
			$value[ 'o_Fecha_Inicio' ]        = new \DateTime( date($value[ 'Fecha_Inicio' ]) );
			$value[ 'inicio_mes_anio' ]       = $value[ 'o_Fecha_Inicio' ]->format('Y').$value[ 'o_Fecha_Inicio' ]->format('m');
			$value[ 'fecha_inicio_tooltip' ]  = $value[ 'o_Fecha_Inicio' ]->format('d/m/Y');
			$value[ 'o_Fecha_termino' ]       = new \DateTime( date($value[ 'Fecha_termino' ]) );
			$value[ 'fecha_termino_tooltip' ] = $value[ 'o_Fecha_termino' ]->format('d/m/Y');
			$value[ 'termino_mes_anio' ]      = $value[ 'o_Fecha_termino' ]->format('Y').$value[ 'o_Fecha_termino' ]->format('m');
		}

		return $arrCursosDisponibles;
	}

	public function filtrarSelectSucursales($arrSucursales)
	{
		$idEmpresa  = $this->container->get('session')->get('idEmpresa', 'todas');
		$idSucursal = $this->container->get('session')->get('idSucursal', 'todas');

		if ($idEmpresa === 'todas' && $idSucursal === 'todas') {
			return $arrSucursales;
		}

		if ($idEmpresa != 'todas') {

			$arrTemporal = [];
			
			foreach ($arrSucursales as $value) {
				if ($idEmpresa === $value['idEmpresa']) {
					$arrTemporal[] = $value;
				}
			}

			$arrSucursales = $arrTemporal;
		}

		if ($idSucursal != 'todas') {

			$arrTemporal = [];
			
			foreach ($arrSucursales as $value) {
				if ($idSucursal === $value['idSucursal']) {
					$arrTemporal[] = $value;
				}
			}

			$arrSucursales = $arrTemporal;
		}

		return $arrSucursales;
	}

	public function filtrarSucursalesConCurso($arrSucursales, $arrCursosDisponibles)
	{
		$arrSucursalesConCurso = [];

		foreach ($arrCursosDisponibles as $curso) {
			foreach ($arrSucursales as $sucursal) {
				if ($sucursal['idEmpresa'] != $curso['Cod_empresa']) {
					continue;
				}

				if ($sucursal['idSucursal'] != $curso['Cod_sucursal']) {
					continue;
				}

				$arrSucursalesConCurso[$sucursal['idSucursal'].$curso['Cod_sucursal']] = $sucursal;
			}
		}

		return $arrSucursalesConCurso;
	}

	public function filtrarSelectSucursalesReporte($arrSucursales, $idEmpresa, $idSucursal)
	{
		if ($idEmpresa === 'todas' && $idSucursal === 'todas') {
			return $arrSucursales;
		}

		if ($idEmpresa != 'todas') {

			$arrTemporal = [];
			
			foreach ($arrSucursales as $value) {
				if ($idEmpresa === $value['idEmpresa']) {
					$arrTemporal[] = $value;
				}
			}

			$arrSucursales = $arrTemporal;
		}

		if ($idSucursal != 'todas') {

			$arrTemporal = [];
			
			foreach ($arrSucursales as $value) {
				if ($idSucursal === $value['idSucursal']) {
					$arrTemporal[] = $value;
				}
			}

			$arrSucursales = $arrTemporal;
		}

		return $arrSucursales;
	}

	public function obtenerMesesEntreFechas($fechaInicio, $fechaTermino)
	{
		$fechaTermino   = new \DateTime( date($fechaTermino) );

		$inicio     = (new \DateTime( date($fechaInicio) ))->modify('first day of this month');
		$termino    = $fechaTermino->modify('last day of this month');
		
		$hoy        = new \DateTime();
		$hoymesanio = $hoy->format('Y').$hoy->format('m');
		
		$intervalo  = \DateInterval::createFromDateString('1 month');
		
		$periodo    = new \DatePeriod($inicio, $intervalo, $termino);
		
		$arrMeses   = [];

		$bloque     = 2;

		foreach ($periodo as $date) {
			$numeroMes            = $date->format('Y').$date->format('m');
			$mes                  = [];

			$mes['nombre']        = $this->obtenerNombreMes($date->format('m'));
			$mes['esPasado']      = ($hoymesanio > $numeroMes)? true: false;
			$mes['bloque']        = ($mes['esPasado'])? 1: false;
			$mes['mes']           = $date->format('m');
			$mes['anio']          = $date->format('Y');
			$mes['numdias']       = $date->format('t');

			if ($mes['bloque'] === false) {
				$mes['bloque'] = $bloque;
				$bloque++;
			}
			
			$arrMeses[$numeroMes] = $mes;
		}

		return $arrMeses;
	}

	public function obtenerSumaFacturacion($arrCursosReporte)
	{
		$suma = 0;

		foreach ($arrCursosReporte as $curso) {
			$suma = $suma + $curso[ 'Monto_Facturado' ];
		}

		return $suma;
	}

	public function obtenerSumaPagado($arrCursosReporte)
	{
		$suma = 0;

		foreach ($arrCursosReporte as $curso) {
			$suma = $suma + $curso[ 'Monto_Pagado' ];
		}

		return $suma;
	}

	public function obtenerSumaAlumnosPorCurso($arrCursosReporte)
	{
		$suma = [];

		foreach ($this->tiposVehiculos as $key => $value) {
			$suma[ $key ][ 'suma_alumnos' ]    = 0;
			$suma[ $key ][ 'monto_facturado' ] = 0;
			$suma[ $key ][ 'utilidad_real' ]   = 0;
			$suma[ $key ][ 'cantidad' ]        = 0;
		}

		foreach ($arrCursosReporte as $curso) {
			if ($curso[ 'Monto_Facturado' ] == 0) {
				continue;
			}

			$tipoCurso = strtoupper(str_replace(' ', '_', $curso[ 'Tipo_Curso' ]));
			
			$suma[ $tipoCurso ][ 'suma_alumnos' ]    += $curso[ 'Num_Alumnos_Actual' ];
			$suma[ $tipoCurso ][ 'monto_facturado' ] += $curso[ 'Monto_Facturado' ];
			$suma[ $tipoCurso ][ 'utilidad_real' ]   += $curso[ 'Porcentaje_Utilidad_real' ];
			$suma[ $tipoCurso ][ 'cantidad' ]        += 1;
		}

		return $suma;
	}

	public function obtenerRelatores($arrCursosReporteActual, $arrCursosReporteAnterior)
	{
		$arrRelatores = [];

		foreach ($arrCursosReporteActual as $curso) {
			$arrRelatores[ $curso[ 'Relator_Actual' ] ] = $curso[ 'Relator_Actual' ];
		}

		foreach ($arrCursosReporteAnterior as $curso) {
			$arrRelatores[ $curso[ 'Relator_Actual' ] ] = $curso[ 'Relator_Actual' ];
		}

		return $arrRelatores;
	}

	public function obtenerSumaAlumnosPorRelator($arrCursosReporte, $arrRelatores)
	{
		$suma = [];

		foreach ($arrRelatores as $key => $value) {
			$suma[ $key ][ 'suma_alumnos' ]    = 0;
			$suma[ $key ][ 'monto_facturado' ] = 0;
			$suma[ $key ][ 'utilidad_real' ]   = 0;
			$suma[ $key ][ 'cantidad' ]        = 0;
		}

		foreach ($arrCursosReporte as $curso) {
			if ($curso[ 'Monto_Facturado' ] == 0) {
				continue;
			}
			
			$relator = $curso[ 'Relator_Actual' ];
			
			$suma[ $relator ][ 'suma_alumnos' ]    += $curso[ 'Num_Alumnos_Actual' ];
			$suma[ $relator ][ 'monto_facturado' ] += $curso[ 'Monto_Facturado' ];
			$suma[ $relator ][ 'utilidad_real' ]   += $curso[ 'Porcentaje_Utilidad_real' ];
			$suma[ $relator ][ 'cantidad' ]        += 1;
		}

		return $suma;
	}

	public function obtenerDiaActual()
	{
		$dia = new \DateTime();

		$strDia = '';

		$strDia .= $this->obtenerNombreDia($dia->format('N'));
		$strDia .= ', ';
		$strDia .= $dia->format('d');

		return $strDia;
	}

	private function obtenerNombreMes($numero)
	{
		switch ($numero) {
			case '01':
			return 'Enero';
			break;
			case '02':
			return 'Febrero';
			break;
			case '03':
			return 'Marzo';
			break;
			case '04':
			return 'Abril';
			break;
			case '05':
			return 'Mayo';
			break;
			case '06':
			return 'Junio';
			break;
			case '07':
			return 'Julio';
			break;
			case '08':
			return 'Agosto';
			break;
			case '09':
			return 'Septiembre';
			break;
			case '10':
			return 'Octubre';
			break;
			case '11':
			return 'Noviembre';
			break;
			case '12':
			return 'Diciembre';
			break;
			default:
			return 'none';
			break;
		}
	}

	private function obtenerNombreDia($numero)
	{
		switch ($numero) {
			case '1':
			return 'Lunes';
			break;
			case '2':
			return 'Martes';
			break;
			case '3':
			return 'Miércoles';
			break;
			case '4':
			return 'Jueves';
			break;
			case '5':
			return 'Viernes';
			break;
			case '6':
			return 'Sábado';
			break;
			case '7':
			return 'Domingo';
		}
	}

	private function ordenarCursosDeUnTipoCurso($arrCursos)
	{
		$cantidadCursos  = COUNT($arrCursos);
		$cursosOrdenados = [];
		$posicionInicial = 0;
		$posicionFinal   = 1;

		for ($i=0; $i <= $cantidadCursos; $i++) {
			if (array_key_exists($i, $arrCursos)) {
				$cursosOrdenados[ $posicionInicial ] = $arrCursos[ $i ];
				$posicionInicial                     = $posicionInicial + 2;
				unset( $arrCursos[ $i ] );
			}

			if (array_key_exists( ($cantidadCursos - $i), $arrCursos)) {
				$cursosOrdenados[ $posicionFinal ] = $arrCursos[ $cantidadCursos - $i ];
				$posicionFinal                     = $posicionFinal + 2;
				unset( $arrCursos[ $cantidadCursos - $i ] );
			}
		}

		return $cursosOrdenados;
	}

}
