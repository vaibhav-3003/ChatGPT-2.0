<?php
$featuresData = array(
    array(
        "title" => "Improving end distrusts instantly",
        "text" => "From they fine john he give of rich he. They age and draw mrs like. Improving end distrusts may instantly was household applauded."
    ),
    array(
        "title" => "Become the tended active",
        "text" => "Considered sympathize ten uncommonly occasional assistance sufficient not. Letter of on become he tended active enable to."
    ),
    array(
        "title" => "Message or am nothing",
        "text" => "Led ask possible mistress relation elegance eat likewise debating. By message or am nothing amongst chiefly address."
    ),
    array(
        "title" => "Really boy law county",
        "text" => "Really boy law county she unable her sister. Feet you off its like like six. Among sex are leave law built now. In built table in an rapid blush.."
    ),
);
?>

<div class="gpt3__features section__padding" id="case_studies">
    <div class="gpt3__features-heading">
        <h1 class="gradient__text">
            The Future is Now and You Just Need to Realize It. Step into Future
            Today. & Make it Happen.
        </h1>
        <p>Request Early Access to Get Started</p>
    </div>
    <div class="gpt3__features-container">
        <?php
            foreach ($featuresData as $data) {
                $title = $data['title'];
                $text = $data['text'];
                include 'resources\views\components\feature\feature.php';
            }
        ?>
    </div>
</div>