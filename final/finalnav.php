<!-- ######################     Main Navigation   ########################## -->
<nav class="nav">
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "home") {
            print ' activePage ';

        }
        print '">';
        print '<a href="home.php">Home</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "collection") {
            print ' activePage ';
        }
        print '">';
        print '<a href="collection.php">The Collection</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "reviews") {
            print ' activePage ';
        }
        print '">';
        print '<a href="reviews.php">Reviews</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "releases") {
            print ' activePage ';
        }
        print '">';
        print '<a href="releases.php">New Releases</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "submissions") {
            print ' activePage ';
        }
        print '">';
        print '<a href="submissions.php">Submissions</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "final_form") {
            print ' activePage ';
        }
        print '">';
        print '<a href="final_form.php">Form</a>';
        print '</li>';

        ?>
    </ol>
</nav>