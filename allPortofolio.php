<?php
    include('./tambahportofolio/common/config.php');
    $sub = mysqli_query($con,"SELECT * FROM projects ORDER BY project_date DESC");
    while($row=mysqli_fetch_array($sub)){
        ?>
        <div class="col-sm-6 col-md-6 col-lg-4 h-100 myporto mt-5" data-aos="zoom-out" data-aos-easing="linear">
            <a class="project-links" href="portofolioDetail.html?kode=<?php echo htmlentities($row['id_project']) ?>" style="text-decoration:none">
                <div class="project">
                    <div class="image-place">
                        <img height="268" src="./dokumen/<?php echo htmlentities($row['project_thumbnail']) ?>" alt="">
                    </div>
                    <h1 class="text-center"><?php echo htmlentities($row['project_name']) ?></h1>
                    <?php 
                        $tags = mysqli_query($con, "SELECT * FROM projecttags INNER JOIN tags ON projecttags.id_tag=tags.id_tag WHERE projecttags.id_project='".$row['id_project']."'");
                        $num = mysqli_num_rows($tags);
                        $i=0;
                    ?>
                    <p class="text-center text-dark">Tags : <?php while($tag = mysqli_fetch_array($tags)){ 
                            $i++;
                            if($i != $num){
                                echo htmlentities($tag['tag_name']);
                                echo ", ";    
                            }else{
                                echo htmlentities($tag['tag_name']);
                            }
                        } 
                        ?></p>
                </div>
            </a>
        </div>
        <?php
    }
?>