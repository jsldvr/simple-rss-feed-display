<?php 
/**
 * Require the script to refresh the json file.
 */
require_once('getRSS.php'); 

/**
 * Set some global params
 */
$app = [
    'title' => 'RSS Feed Display'
];

/**
 * Website HTML
 */
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $app['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.css" 
        rel="stylesheet" />

    <style>
        img {
            max-width: 100%;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('#news-table').DataTable({
                    dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                    order: [[0, 'asc']],
                });
            });
        });
    </script>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h1><a href="./"><?php echo $app['title']; ?></a></h1>
                <table class="table display " id="news-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Post</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Read the JSON file contents
                        $file = 'app/data/posts.json';
                        $jsonData = file_get_contents($file);
                        $posts = json_decode($jsonData, true);

                        // Display each post
                        foreach ($posts as $post) { ?>

                        <tr class="post">
                            <td>
                                <time><?php echo $post['pubDate']; ?></time>
                            </td>
                            <td>
                                <div class="fw-bold fs-5 mb-2"><a href="<?php echo $post['link']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $post['title']; ?></a></div>
                                <section><?php echo $post['description']; ?></section>
                            </td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>