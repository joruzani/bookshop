<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active">
               <a> 
                Busqueda
               </a>
            </li>
        </ul>
        <form class="nav nav-sidebar" id="searc">
            <div class="form-group">
                <input type="text" v-model="searchName" name="query" class"form-control" placeholder="Autor, Titulo o Precio(exacto)">
            </div>
            <div class="form-group">
                <input type="date" v-model="bdate" name="query" class"form-control" placeholder="Fecha de publicacion"></br>
                <input type="radio" v-model="newer"  value="false"> antes de 
                <input type="radio" v-model="newer"  value="true"> despues de 
            </div>
            <div class="form-group">
                <input type="text" v-model="bprice" name="query" class"form-control" placeholder="Precio" number></br>
                <input type="radio" v-model="cheaper"  value="false"> mayor a
                <input type="radio" v-model="cheaper"  value="true"> menor a
            </div>
        </form>
    </div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <div  class="row placeholders">
            <div v-repeat="books | filterBy searchName | price | published" class="col-xs-6 col-sm-3 placeholder">
              <img class="img-responsive" height="320px" src="{{image_url}}" >
              <h4 class="text-right">{{title}}</h4>
              <p class="text-muted text-right">{{lastname}}, {{name}}</p><p class="text-right">{{price}}</p>
              <a class="btn btn-default" href="/index.php/catalog/edit/{{id_book}}" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> edit</a>
            </div>
          </div>
        </div>


</div>
