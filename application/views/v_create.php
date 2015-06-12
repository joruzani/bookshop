<div class="row">
    <div class="form-horizontal">
        <h3 class="col-sm-offset-3 col-sm-9">Add a new book to the catalog</h3>
        <?php echo validation_errors(); ?>
        <?php echo form_open('/index.php/catalog/create')?>

            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>  
                <div class="col-sm-9">
                    <input type="text" name="title" >
                </div>
            </div>
            <div class="form-group">
                <label for="author" class="col-sm-3 control-label">Author</label>  
                <div class="col-sm-9">
                    <select name="author" >
                        <?php
                            foreach($authors as $author){
                                echo '<option value="'.$author->id_author. '">'.$author->name. ' ' . $author->lastname .'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="publication" class="col-sm-3 control-label">Publication</label>  
                <div class="col-sm-9">
                    <input type="date" name="publication" >
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price</label>  
                <div class="col-sm-9">
                    <input type="text" name="price" >
                </div>
            </div>
            <div class="form-group">
                <label for="imageUrl" class="col-sm-3 control-label">Image URL</label>  
                <div class="col-sm-9">
                    <input type="text" name="imageUrl" >
                </div>
            </div>
            <div class="form-group">
                <label for="ISBN" class="col-sm-3 control-label">ISBN</label>  
                <div class="col-sm-9">
                    <input type="text" name="isbn" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button  type="submit" class="btn btn-default" name="submit" ><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save new book</button>
                </div>
            </div>
        </form>
    </div>
</div>
