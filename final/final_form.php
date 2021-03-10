<?php
include ("finaltop.php");
$dataIsGood = false;

function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}
?>

<main>
    <article>
        <?php
        // process form when it is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // we only save the data if it is good so we need to make a flag
            // notice if the data fails a check i set this flag to false
            $dataIsGood = true;

            // Server side Sanatize values

            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $artistname = getData("txtArtistName");
            $albumname = getData("txtAlbumName");
            $review = getData("txtRev");
            $author = getData("Author");
            $media = getData("chkMedia");
            $firstname = getData("txtFirstName");
            $lastname = getData("txtLastName");
            $updates = getData("updates");

            // Server side Validation
            if ($email == "") {
                print '<p class="mistake">Please enter your email address.</p>';
                $dataIsGood = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // filter var returns true if it is valid, the ! says if it is not good
                print '<p class="mistake">Your email address appears to be incorrect.</p>';
                $dataIsGood = false;
            }

            if ($updates != 'Yes' AND $updates != 'No' AND $updates != 'Only') {
                print '<p class="mistake">Please choose an option.</p>';
                $dataIsGood = false;
            }

            if ($dataIsGood) {
                // save the data
                try {
                    // Try to insert the submitted values using a prepared statement
                    $sql = 'INSERT INTO Reviews (fldArtistName, fldAlbumName, fldRev, fldAuthor, fldMedia, fldFirstName, fldLastName, fldEmail, fldUpdates)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $statement = $pdo->prepare($sql);
                    $params = [$artistname, $albumname, $review, $author, $media, $firstname, $lastname, $email, $updates];
                    $statement->execute($params);
                    print '<p>Record successfully inserted.</p>';
                } catch (PDOException $e) {
                    print '<p>Couldn\'t insert the record.</p>';
                } //end try
            } // ends data is good
        } // ends form was submitted

        // if the data is good we will email the person and display a message,
        // otherwise we display the form
        if ($dataIsGood) {
            $to = $email;
            $from = 'Frequency Music Co.<smaltby>';
            $subject = 'CS 008 Research Project';
            $mailMessage = '<p style="font: 14pt serif;">Thank you for submitting a review!</p><p><span style="color: #006980; padding-left: 5em;">Sam Maltby</span></p>';
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: " . $from . "\r\n";


            $mailedSent = mail($to, $subject, $mailMessage, $headers);

            if ($mailedSent) {
                print "<p>Mail sent successfully</p>";
            }

            print '<h2>Thank you, your information has been received.</h2>';

            die(); // just stop at this point we dont want to display the form
        }
        ?>



        <h2>Submit a Review:</h2>
        <form action ="<?php print $phpSelf; ?>"
              id ="frmForm"
              method ="post"
        >
            <!--First form box-->
            <fieldset class="details">
                <legend>Review Details:</legend>
                <p>
                    <label for="txtArtistName">Artists's Name:</label>
                    <input
                        id="txtArtistName"
                        maxlength="45"
                        name="txtArtistName"
                        type="text"
                        onfocus="this.select()"
                        placeholder="Enter Artist's Name"
                        tabindex="120"
                        value=""
                    >
                </p>
                <p>
                    <label for="txtAlbumName">Album Name:</label>
                    <input
                            id="txtAlbumName"
                            maxlength="45"
                            name="txtAlbumName"
                            type="text"
                            onfocus="this.select()"
                            placeholder="Enter Album Name"
                            tabindex="120"
                            value=""
                    >
                </p>
                <p>
                    <label for="txtRev">Review:</label>
                    <textarea
                        id="txtRev"
                        name="txtRev"
                        placeholder="Type Review Here"
                        rows="7"
                        cols="50"
                    ></textarea>
                </p>
                <p>  <!--List Box-->
                    <label for="selAuthor">Are you the author of this review?</label>
                    <select name="Author" id="selAuthor" size="2" multiple>
                        <option value="">--Please choose an option--</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                        <option value="anonymous">I'd prefer to remain anonymous</option>
                    </select>
                </p>
                <p>How did you find this album?</p>
                <p>   <!--Radio Buttons-->
                    <label class="chkbox">
                    <input
                        type="checkbox"
                        id="chkSpot"
                        name="chkMedia"
                        value="Spotify"
                    > Spotify</label>
                </p>
                <p>
                    <label class="chkbox">
                    <input
                        type="checkbox"
                        id="chkApp"
                        name="chkMedia"
                        value="Apple Music"
                    > Apple Music</label>
                </p>
                <p>
                    <label class="chkbox">
                    <input
                        type="checkbox"
                        id="chkPan"
                        name="chkMedia"
                        value="Pandora"
                    > Pandora</label>
                </p>
                <p>
                    <label class="chkbox">
                    <input
                        type="checkbox"
                        id="chkWeb"
                        name="chkMedia"
                        value="Website"
                    > Website</label>
                </p>
                <p>
                    <label class="chkbox">
                    <input
                        type="checkbox"
                        id="chkOther"
                        name="chkMedia"
                        value="Other"
                    > Other</label>
                </p>
            </fieldset>

                <!--Contact Box-->
            <fieldset class="contact">
                <legend>Contact Information:</legend>
                <p>
                    <label for="txtFirstName">First Name:</label>
                    <input
                        id="txtFirstName"
                        maxlength="45"
                        name="txtFirstName"
                        type="text"
                        onfocus="this.select()"
                        placeholder="First Name"
                        tabindex="120"
                        value=""
                    >
                </p>
                <p>
                    <label for="txtLastName">Last Name:</label>
                    <input
                        id="txtLastName"
                        maxlength="45"
                        name="txtLastName"
                        type="text"
                        onfocus="this.select()"
                        placeholder="Last Name"
                        tabindex="120"
                        value=""
                    >
                </p>
                <p>
                    <label for="txtEmail">Email:</label>
                    <input
                        id="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        type="text"
                        onfocus="this.select()"
                        placeholder="yourname@example.com"
                        tabindex="120"
                        value=""
                    >
                </p>
                <p>Would you like to receive email updates?</p>
                    <label><input type="radio" name="updates" value="Yes">Yes</label>
                    <label><input type="radio" name="updates" value="No">No</label>
                    <label><input type="radio" name="updates" value="Only">Only submission updates</label>

            </fieldset>

                <!--Submit Button-->
            <fieldset class="buttons">
                <input
                    type="submit"
                    id="btnSubmit"
                    name="btnSubmit"
                    value="Submit"
                    tabindex="900"
                    class="button"
                >
            </fieldset>
        </form>




    </article>


</main>
<?php include ("finalfooter.php"); ?>
</body>
</html>


