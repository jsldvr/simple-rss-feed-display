<!DOCTYPE html>
<html lang="en">

<?php require 'template/head.php'; ?>

<body>
    <?php require 'template/header.php'; ?>

    <main>
        <!-- News Feed Section -->
        <section id="news-feed" class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- News Articles -->
                    <div class="card mb-3">
                        <img src="article-image.jpg" class="card-img-top" alt="Article Image">
                        <div class="card-body">
                            <h5 class="card-title">Article Title</h5>
                            <p class="card-text">Article Description</p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Sidebar -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Popular Articles</h5>
                            <ul class="list-group">
                                <li class="list-group-item">Article 1</li>
                                <li class="list-group-item">Article 2</li>
                                <li class="list-group-item">Article 3</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require 'template/footer.php'; ?>

</body>

</html>