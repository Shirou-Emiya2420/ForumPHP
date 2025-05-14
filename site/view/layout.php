<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <title>FORUM</title>
    </head>
    <body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
        <div id="wrapper" class="flex-grow">
            <div id="mainpage" class="container mx-auto p-4">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message text-red-600 font-semibold mb-2"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message text-green-600 font-semibold mb-2"><?= App\Session::getFlash("success") ?></h3>

                <header class="bg-white shadow mb-6">
                    <nav class="flex justify-between items-center p-4">
                        <div id="nav-left" class="flex space-x-4">
                            <a href="index.php" class="hover:text-blue-500 font-semibold">Accueil</a>
                            <?php if(App\Session::isAdmin()): ?>
                                <a href="index.php?ctrl=home&action=users" class="hover:text-blue-500">Voir la liste des gens</a>
                            <?php endif; ?>
                        </div>
                        <div id="nav-right" class="flex space-x-4">
                            
                        <?php if(App\Session::getUser()): ?>
                            <a href="index.php?ctrl=security&action=profile" class="hover:text-blue-500">
                                <span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?>
                            </a>
                            <a href="index.php?ctrl=security&action=logout" class="hover:text-red-500">Déconnexion</a>
                        <?php else: ?>
                            <a href="index.php?ctrl=security&action=login" class="hover:text-blue-500">Connexion</a>
                            <a href="index.php?ctrl=security&action=register" class="hover:text-blue-500">Inscription</a>
                            <a href="index.php?ctrl=forum&action=index" class="hover:text-blue-500">Liste des catégories</a>
                        <?php endif; ?>
                        </div>
                    </nav>
                </header>

                <main id="forum" class="bg-white p-6 rounded shadow">
                    <?= $page ?>
                </main>
            </div>

            <footer class="bg-white text-center text-sm py-4 border-t">
                <p>&copy; <?= date_create("now")->format("Y") ?> - 
                    <a href="#" class="text-blue-500 hover:underline">Règlement du forum</a> - 
                    <a href="#" class="text-blue-500 hover:underline">Mentions légales</a>
                </p>
            </footer>
        </div>

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>
