
var demo = new Vue({
  el: '#demo',

  data:{
      cheaper: 'true',
      newer: 'false',
      bprice: 40,
      bdate: '2015-06-10',
      books: [],
  },

  ready: function(){
      this.fetchBooks();
  },

  filters: {
        price: function(books){
            var self = this;
            if(!this.bprice) { return books; } 
            return books.filter(function(book){
                if(self.cheaper == 'true'){
                    return parseFloat(book.price) <= self.bprice;
                }else { return parseFloat(book.price) >= self.bprice; }
            });
        },
        
        published: function(books){
            var self = this;
            if( isNaN(parseInt(this.bdate.substr(0,4))) || isNaN(parseInt(this.bdate.substr(5,6))) || isNaN(parseInt(this.bdate.substr(8,9))) ) { return books; } 
            return books.filter(function(book){
                var bookdate = new Date;
                bookdate.setYear(parseInt(book.publication.substr(0,4)));
                bookdate.setMonth(parseInt(book.publication.substr(5,6)));
                bookdate.setDate(parseInt(book.publication.substr(8,9)));
                var sdate = new Date;
                sdate.setYear(parseInt(self.bdate.substr(0,4)));
                sdate.setMonth(parseInt(self.bdate.substr(5,6)));
                sdate.setDate(parseInt(self.bdate.substr(8,9)));
                if(self.newer == 'true'){
                    return bookdate > sdate;
                }else { return bookdate < sdate; }
            });
        }
  },

  methods:{

      fetchBooks: function(){
          this.$http.get('/index.php/catalog/books', function(catalog){
              this.books = catalog.books;
          });
      },
  }

});
