<?php

require __DIR__ . '/vendor/autoload.php';

use App\GameBoard;
use App\WinValidated;
use App\Session;

$session = new Session();
$firstPlayer = $session->getAttribute('firstPlayer');
$secondPlayer = $session->getAttribute('secondPlayer');

?>

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
                <?php if(!$_REQUEST): ?>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Bienvenido al juego 3 en raya</p>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">Juega con tus amigos para saber quien es el mejor en 3 en raya</p>
                <?php else: ?>
                    <?php if($firstPlayer && $secondPlayer): ?>
                        <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"> <?= "$firstPlayer vs $secondPlayer" ?> </h2>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="mt-20 max-w-lg sm:mx-auto md:max-w-none flex flex-col items-center">
                <?php if($_REQUEST):
                    $gameBoard = new GameBoard;
                    if ($_POST):
                        //$firstPlayer = new Players($_POST['playerOne'], $_POST['playerTwo']);
                        $gameBoard->initialize();
                        $playerTurn = 1;
                    else:
                        $playerTurn = $_GET['turn'];
                        $gameBoard->savePositionInGame($_GET['pos'], $playerTurn);
                    endif; ?>

                    <?php if ($playerTurn == 2): ?>
                        <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600"><?= "El turno es para: $secondPlayer"; ?></p>
                        <?php $playerTurn = 1; ?>
                    <?php else: ?>
                        <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600"><?= "El turno es para: $firstPlayer"; ?></p>
                        <?php $playerTurn = 2; ?>
                    <?php endif; ?>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="border-collapse border border-slate-500">
                                        <tbody>
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                                <tr class="bg-white border-b">
                                                    <?php for ($j = 1; $j <= 3; $j++): ?>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r"><?= $gameBoard->showPositions($i . $j, $playerTurn) ?></td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <form name="empezar" action="index.php" method="post">
                                <input type="hidden" name="playerOne" value="<?= $firstPlayer ?>">
                                <input type="hidden" name="playerTwo" value="<?= $secondPlayer ?>">
                                <div class="py-4">
                                    <button type="submit" name="empezar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                        Volver a empezar
                                    </button>
                                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="index.php">
                                        Terminar Juego
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <form name="juego" action="index.php" method="post">
                        <div class="grid grid-cols-1 gap-y-16 md:grid-cols-2 md:gap-x-12 md:gap-y-16">
                            <div class="relative flex flex-col gap-6 sm:flex-row md:flex-col lg:flex-row">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-white sm:shrink-0">
                                    <img width="20px" src="./public/img/x.jpg" alt="x">
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
                                    <img width="20px" src="./public/img/o.jpg" alt="x">
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
                <?php endif; ?>
            </div>
            <?php if($_REQUEST):
                $validateGame = new WinValidated; ?>
                <?php if ($validateGame->validated()): ?>
                    <div class="relative flex justify-center items-center">
                        <div id="menu" class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
                            <div class="2xl:container  2xl:mx-auto py-48 px-4 md:px-28 flex justify-center items-center">
                                <div class="w-96 md:w-auto dark:bg-gray-800 relative flex flex-col justify-center items-center bg-white py-16 px-4 md:px-24 xl:py-24 xl:px-36">
                                    <div class="mt-12">
                                        <h1 role="main" class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-center text-gray-800">
                                            <?= "El jugador ganador es {$validateGame->validated()}"; ?>
                                        </h1>
                                    </div>
                                    <button onclick="showMenu(true)" class="text-gray-800 dark:text-gray-400 absolute top-8 right-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800" aria-label="close">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    </body>

    <script>
        let menu = document.getElementById("menu");
        const showMenu = (flag) => {
            menu.classList.toggle("hidden");
        };
    </script>
</html>