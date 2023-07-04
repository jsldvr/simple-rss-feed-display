<main class="container py-2">
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
                                <div class="fw-bold fs-5 mb-2">
                                    <a href="<?php echo $post['link']; ?>" target="_blank" rel="noopener noreferrer">
                                        <?php echo $post['title']; ?>
                                    </a>
                                </div>
                                <div><?php echo $limitDesc; ?></div>
                                <div class="text-success-emphasis text-wrap my-3">
                                    <?php echo $post['link'] . "\n"; ?>
                                </div>
                                <div class="my-3">
                                    <a class="twitter-share-button btn btn-sm btn-outline-primary" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo $post['link'] . "\n"; ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-twitter"></i> Tweet
                                    </a>
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
</main>