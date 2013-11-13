<html>
    <head>
        <title>Sample MVC Demonstration</title>
    </head>
    <body style="margin: auto;">
        <?php if (isset($this->data['message'])) { ?>
            <h3 style="color:red"><?php echo $this->data['message']; ?></h3><br/>
        <?php } ?>