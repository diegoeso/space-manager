@switch(Auth::user()->tipoCuenta)
    @case(0)
        Administrador
        @break
	@case(0)
        Responsable de Area
        @break
	@case(0)
        Profesor
        @break
	@case(0)
	    Alumno
	    @break
    @default
         Usuario
@endswitch
