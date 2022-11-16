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
            <?php if(isset($data['firstPlayer']) && isset($data['secondPlayer'])): ?>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    <?= "{$data['firstPlayer']['name']} vs {$data['secondPlayer']['name']}" ?>
                </h2>
            <?php endif; ?>
        </div>
        
        <div class="mt-20 max-w-lg sm:mx-auto md:max-w-none flex flex-col items-center">
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                <?= "El turno es para: {$data['playerTurn']}"; ?>
            </p>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="border-collapse border border-slate-500">
                                <tbody>
                                <?php if(isset($data['firstPlayer']) && isset($data['secondPlayer'])):
                                        $createTr = true;
                                        foreach(json_decode($data['gamePositions']) as $key => $position): ?>
                                            <?php if(str_ends_with($key, "1")): ?>
                                                <tr class="bg-white border-b">
                                            <?php endif; ?>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r"><?= showPositions($key, $position) ?></td>
                                            <?php if(str_ends_with($key, "3")): ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <form name="empezar" action="/game/store" method="post">
                        <input type="hidden" name="playerOne" value="<?= $data['firstPlayer']['name'] ?>">
                        <input type="hidden" name="playerTwo" value="<?= $data['secondPlayer']['name'] ?>">
                        <div class="py-4">
                            <button type="submit" name="restart" value="<?= true ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                Volver a empezar
                            </button>
                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/base/index">
                                Terminar Juego
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php $validateGame = new App\Services\WinValidatedService; ?>
    <?php if($data['firstPlayer'] && $data['secondPlayer']): ?>
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
</body>
<script>
    let menu = document.getElementById("menu");
    const showMenu = (flag) => {
        menu.classList.toggle("hidden");
    };
</script>
</html>