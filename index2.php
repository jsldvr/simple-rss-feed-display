<?php

/**
 * Require the script to refresh the json file.
 */
require_once('getRSS.php');

/**
 * Set some global params
 */
$app = [
    'title' => 'rssNewsFeed'
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

    <link rel="stylesheet" href="app/style/bootstrap.min.css">
    <link rel="stylesheet" href="app/style/bootstrap-icons.css">
    <link rel="stylesheet" href="app/style/datatables.min.css">
    <link rel="stylesheet" href="app/style/default.css">

    <style>
        img {
            max-width: 100%;
        }

        a {
            text-decoration: none;
        }
    </style>

    <script src="app/scripts/jquery-3.5.1.js"></script>
    <script src="app/scripts/bootstrap.bundle.min.js"></script>
    <script src="app/scripts/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#news-table').DataTable({
                dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MZSSKV52P7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-MZSSKV52P7');
    </script>
</head>

<body>
    <header class="container py-2 mt-3">
        <div class="row">
            <div class="col">
                <h1><a href="./"><i class="bi bi-rss-fill"></i> <?php echo $app['title']; ?></a></h1>
            </div>
        </div>
    </header>
    <div class="container py-2">
        <div class="row">
            <div class="col">
                <table class="table w-100" id="news-table">
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
                        foreach ($posts as $post) {
                            $desc = $post['description'];
                            $stripDesc = strip_tags($desc);
                            $limitDesc = substr($stripDesc, 0, 512)
                        ?>

                            <tr class="post">
                                <td>
                                    <time><?php echo $post['pubDate']; ?></time>
                                </td>
                                <td>
                                    <div class="fw-bold fs-5 mb-2"><a href="<?php echo $post['link']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $post['title']; ?></a></div>
                                    <div><?php echo $limitDesc; ?></div>
                                    <div class="text-success-emphasis text-wrap my-3">
                                        <?php echo $post['link'] . "\n"; ?>
                                    </div>
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
    <footer class="container">
        <div class="row">
            <div class="col py-2 mb-3">
                <p>&copy; 2023. All rights reserved. </p>
                <p class="fw-bold mt-3">Disclaimer: </p>
                <p>The information provided on this website is for general informational purposes only. The content displayed here is sourced from various RSS feeds and is subject to change without notice. We make no representations or warranties of any kind, express or implied, about the accuracy, reliability, suitability, or availability of the information contained on this website. </p>
                <p>Any reliance you place on such information is strictly at your own risk. We disclaim any responsibility for any loss, damage, or inconvenience caused by the use of or reliance on any content or information provided on this website. </p>
                <p>We strive to keep the website up and running smoothly. However, we take no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control. </p>
                <p>Please note that the content displayed here may contain external links to other websites. We do not have control over the nature, content, and availability of those sites. The inclusion of any external links does not necessarily imply a recommendation or endorsement of the views expressed within them.</p>
                <p>By using this website, you agree to these terms and conditions of use and acknowledge that any reliance on the information provided is solely at your own risk.</p>
            </div>
        </div>
    </footer>
</body>

</html>