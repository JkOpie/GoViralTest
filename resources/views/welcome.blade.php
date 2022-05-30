<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>POS Cashier</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a894dfe518.js" crossorigin="anonymous"></script>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <!-- Main ccs-->
        <link rel="stylesheet" href="{{asset('main.css')}}">

        <style>
            .product_item{
                background: #6b7280;
                height:100px;
                border-radius: 5px;
                margin-top: 1rem;

                display: flex;
                justify-content: center;
                align-items: center;

                color: #fff;
                cursor: pointer;
            }

            .product_quantity{
                border-radius: 50% !important;
                width: 2rem !important;
                height: 2rem !important;
                padding: 0 !important;
            }

            .product_quantity.right{
                top: -5px;
                left: 0;
            }
            .product_quantity.left{
                top: -5px;
                right: 0;
            }

           
            .list-group-item{
                background-color: #2d3748 !important;
                color: #fff !important;   
                padding-top: 0.9rem !important;
                padding-bottom: 0.9rem !important;         
                border-bottom: 1px solid #fff !important;
                border-top: none !important;
                border-left: none !important;
                border-right: none !important;
                cursor: pointer;
            }

            .list-group-item.active{
                background: #6b7280 !important;
            }

            .btn-cancel, .btn-checkout{
                width: 40%;
                height: 100px;
            }

            hr{
                margin: 0.5rem 0 !important;
            }

        </style>

        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

        <!-- SweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                color: '#fff',
                iconColor: '#fff',
                background: '#198754',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        </script>
    </head>
    <body class="antialiased">

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-4 sm:pt-0 ">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            @include('orders')
        </div>

    </body>

    <script>
       
    </script>
</html>
