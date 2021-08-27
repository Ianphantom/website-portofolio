<?php
    include('./tambahPortofolio/common/config.php');
    if(!empty($_POST['id'])){
        $id = $_POST['id'];
        $getDetail = mysqli_query($con, "SELECT * FROM projects WHERE id_project='".$id."'");
        $row=mysqli_fetch_array($getDetail); ?>
        <div class="row justify-content-md-center detail">
            <div class="col col-md-10">
                <h1>Website <?php echo htmlentities($row['project_name']) ?></h1>
                <div class="time-information">
                    <div class="circle"></div>
                    <div class="who">Ian Felix Jonathan S</div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-9 image">
                        <img class="mobile" src="./dokumen/<?php echo htmlentities($row['project_mobile']) ?>" alt="Tampilan UI Mobile">
                        <img class="website" src="./dokumen/<?php echo htmlentities($row['project_website']) ?>" alt="Tampilan UI Website">
                    </div>
                    <div class="col-md-3 text">
                        <?php echo htmlentities($row['project_explanation']) ?>
                        <?php 
                        $tags = mysqli_query($con, "SELECT * FROM projecttags INNER JOIN tags ON projecttags.id_tag=tags.id_tag WHERE projecttags.id_project='".$row['id_project']."'");
                        $num = mysqli_num_rows($tags);
                        $i=0;
                        ?>
                        <p class="tags">Tags : <?php while($tag = mysqli_fetch_array($tags)){ 
                                $i++;
                                if($i != $num){
                                    echo htmlentities($tag['tag_name']);
                                    echo ", ";    
                                }else{
                                    echo htmlentities($tag['tag_name']);
                                }
                            } 
                        ?></p>
                        <!-- <p class="tags">Tags : HTML, CSS</p> -->
                        <div class="buttons">
                            <div class="button1 text-center"><a href="<?php echo htmlentities($row['project_url']) ?>" target="_blank">Live Website</a></div>
                            <div class="button2 text-center"><a href="<?php echo htmlentities($row['project_github']) ?>"target="_blank">Source</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center detail">
            <div class="col-md-10">
                <h1>Project Goal</h1>
                <p><?php echo htmlentities($row['project_goal']) ?></p>
            </div>
        </div>
    <?php }
?>