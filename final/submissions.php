<?php
include ("finaltop.php");
?>

<main>
    <section class="blocktext">
        <p class="first">
            Here are the submissions from our users. You can submit a review on the 'Form' page and we may feature it on our 'Reviews' page.
        </p>
    </section>

    <section>
        <?php



        $sql = "SELECT fldArtistName, fldAlbumName, fldRev FROM Reviews;";
        $result = ($pdo->query($sql));


        foreach ($pdo->query($sql) as $row) {
            echo "Artist's Name: " . $row["fldArtistname"] . " Album Name: " . $row["fldAlbumName"] . " Review: " . $row["fldRev"] . "<br>";
        }
        ?>
    </section>

</main>

<?php include ("finalfooter.php"); ?>
</body>
</html>