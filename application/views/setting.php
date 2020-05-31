<?php 
if (isset($alert)) {
    print_alert($alert);
}
?>
<div class="card">
    <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
            <h4 class="card-title">Tùy chỉnh</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <form action="" method="post" class="form-horizontal">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Web: Title</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="title" class="form-control" value="<?php echo $setting["title"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Web: Keywork</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="keywork" class="form-control" value="<?php echo $setting["keywork"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Web: Description</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="desc" class="form-control" value="<?php echo $setting["desc"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Web: Favicon</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="favicon" class="form-control" value="<?php echo $setting["favicon"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Web: Email</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="email" class="form-control" value="<?php echo $setting["email"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">URL: Site</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="site_url" class="form-control" value="<?php echo $setting["site_url"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">URL: Home</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group"><input type="text" name="home_url" class="form-control" value="<?php echo $setting["home_url"] ?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Post: Default Status</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group">
                                <select name="post_defaultstatus" id="" class="form-control">
                                    <option value="publish" <?php echo ($setting["post_defaultstatus"]=="publish") ? "selected" : "" ?>>Publish</option>
                                    <option value="private" <?php echo ($setting["post_defaultstatus"]=="private") ? "selected" : "" ?>>Private</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Post: Default Category</label>
                        <div class="col-sm-10">
                            <div class="form-group bmd-form-group">
                                <select name="post_defaultcategory_chuyenmuc" id="" class="form-control">
                                <?php
                                foreach ($cat['chuyen-muc'] as $item) {
                                    $checked = ($item['id'] == $setting['post_defaultcategory']['chuyen-muc'])?"selected":"";
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group bmd-form-group">
                                <select name="post_defaultcategory_tacgia" id="" class="form-control">
                                <?php
                                foreach ($cat['tac-gia'] as $item) {
                                    $checked = ($item['id'] == $setting['post_defaultcategory']['tac-gia'])?"selected":"";
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group bmd-form-group">
                                <select name="post_defaultcategory_bangchucai" id="" class="form-control">
                                <?php
                                foreach ($cat['bang-chu-cai'] as $item) {
                                    $checked = ($item['id'] == $setting['post_defaultcategory']['bang-chu-cai'])?"selected":"";
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group bmd-form-group">
                                <select name="post_defaultcategory_dieubaihat" id="" class="form-control">
                                <?php
                                foreach ($cat['dieu-bai-hat'] as $item) {
                                    $checked = ($item['id'] == $setting['post_defaultcategory']['dieu-bai-hat'])?"selected":"";
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            <button type='submit' class='btn btn-success' name="update">Đồng ý</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>