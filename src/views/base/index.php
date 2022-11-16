<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>3 En Raya</title>
</head>
<body>
<div class="bg-white py-24 sm:py-32 lg:py-40">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="sm:text-center">
            <h2 class="text-lg font-semibold leading-8 text-indigo-600">Juego de 3 en raya</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Bienvenido al juego 3 en raya</p>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">Juega con tus amigos para saber quien es el mejor en 3 en raya</p>
        </div>
        <div class="mt-20 max-w-lg sm:mx-auto md:max-w-none flex flex-col items-center">
            <form name="juego" action="/game/store" method="post">
                <div class="grid grid-cols-1 gap-y-16 md:grid-cols-2 md:gap-x-12 md:gap-y-16">
                    <div class="relative flex flex-col gap-6 sm:flex-row md:flex-col lg:flex-row">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-white sm:shrink-0">
                            <img width="20px" src="../../../public/img/x.jpg" alt="x">
                        </div>
                        <div class="sm:min-w-0 sm:flex-1">
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-2/3">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="playerOne">
                                        Ingrese el nombre del primer jugador
                                    </label>
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="playerOne" name="playerOne" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex flex-col gap-6 sm:flex-row md:flex-col lg:flex-row">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-white sm:shrink-0">
                            <img width="20px" src="../../../public/img/o.jpg" alt="x">
                        </div>
                        <div class="sm:min-w-0 sm:flex-1">
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-2/3">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="playerTwo">
                                        Ingrese el nombre del segundo jugador
                                    </label>
                                    <input id="playerTwo" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="playerTwo" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4">
                    <button type="submit" name="empezar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        COMENZAR JUEGO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>