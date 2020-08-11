<div class="banner">
    <div class="container">
        <h2>A Tech-information platform</h2>
        <p>To add value to Knowledge & skills for professionals</p>
        <a href="#">READ ARTICLE</a>
    </div>
</div>
<!-- technology -->
<div class="technology">
    <div class="container">
        <div class="col-md-9 technology-left">
        <div class="tech-no">
        <?php 
        $allPosts = $postModel::find()->where(['del_status' => '0'])->orderBy(['id' => SORT_DESC])->limit(5)->all();
        foreach($allPosts as $post){?>
            <!-- technology-top -->
            <div class="soci">
                <ul>
                    <li><a href="#" class="facebook-1"> </a></li>
                    <li><a href="#" class="facebook-1 twitter"> </a></li>
                    <li><a href="#" class="facebook-1 chrome"> </a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-envelope"> </i></a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-print"> </i></a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-plus"> </i></a></li>
                </ul>
            </div>
             <div class="tc-ch">
                    <div class="tch-img">
                    <?php $postImage = $postImages::find()->where(['post_id' => $post->id])->one();
                    ?>
                        <a href="<?= '/blog/post-detail?id='.$post->url;?>"><img src="<?= ($postImage->url) ? '/uploads'.$postImage->url :'http://placehold.it/350x150';?>" class="img-responsive" alt="<?=$post->post_title;?>"/></a>
                    </div>
                    <a class="blog blue" href="/">Bakery</a>
                    <h3><a href="<?= '/blog/post-detail?id='.$post->url;?>"><?=$post->post_title;?></a></h3>
                    <p><?= $post->post_excerpt;?></p>
                <div class="blog-poast-info">
                    <ul>
                    <?php $mubUser = $mubUserModel::findOne($post->mub_user_id);
                    ?>
                        <li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"> <?= $mubUser->username;?> </a></li>
                        <li><i class="glyphicon glyphicon-calendar"> </i><?= $post->created_at;?></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php }?>
            </div>
        </div>
        <!-- technology-right -->
        <div class="col-md-3 technology-right">
                <div class="blo-top">
                    <div class="tech-btm">
                    <img src="/images/newsletter.png" class="img-responsive" alt=""/>
                    </div>
                </div>
                <div class="blo-top">
                    <div class="tech-btm">
                    <h4>Sign up to our newsletter</h4>
                    <p>Subscribe to our newsletter to get monthly updates</p>
                        <div class="name">
                            <form>
                                <input type="text" placeholder="Email" required="">
                            </form>
                        </div>  
                        <div class="button">
                            <form>
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                            <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="blo-top1">
                    <div class="tech-btm">
                    <h4>Top stories of the week </h4>
                        <div class="blog-grids">
                            <div class="blog-grid-left">
                                <a href="/"><img src="/images/blog/thumbnail/mixing.jpg" class="img-responsive" alt=""/></a>
                            </div>
                            <div class="blog-grid-right">
                                
                                <h5><a href="/">Mixing section of biscuit industry</a> </h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="blog-grids">
                            <div class="blog-grid-left">
                                <a href="/"><img src="/images/blog/thumbnail/pre-mixing.jpg" class="img-responsive" alt=""/></a>
                            </div>
                            <div class="blog-grid-right">
                                
                                <h5><a href="/">Pre-Minxing section in biscuit Industry</a> </h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="blog-grids">
                            <div class="blog-grid-left">
                                <a href="/"><img src="/images/blog/thumbnail/wheat.jpg" class="img-responsive" alt=""/></a>
                            </div>
                            <div class="blog-grid-right">
                                
                                <h5><a href="/">Casein</a> </h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="blog-grids">
                            <div class="blog-grid-left">
                                <a href="/"><img src="/images/blog/thumbnail/wheat_starch.jpg" class="img-responsive" alt=""/></a>
                            </div>
                            <div class="blog-grid-right">
                                
                                <h5><a href="/">Wheat Type for Biscuit Manufacturing</a> </h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>