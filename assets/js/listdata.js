var save_method, page_now, total_data;

function List(url, state) {
    this.url = url;
    this.state = state;
}

List.prototype.reload = function(page) {
    if(this.state == 'dosenCourses') {
        this.dosenCourses(page, this.url);
    } else if (this.state == 'allCourses') {
        this.allCourses(page, this.url);        
    }
};

List.prototype.dosenCourses = function(page, url) {
    search = 0;
    link = this.url[0] + '/' + page + "/" + 3 + "/" + search;

    page_now = page;

    $('#dosen_courses').html();
    $('#dosen_courses').html('<p><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Mohon tunggu...</p>');

    $.ajax({
        url : link,
        dataType: 'json',
    }).done((data) => {

        if (data.tot_page == 0) {
            $('#dosen_courses').html('<p>Daftar materi kosong.</p>');
        } else {
            inner_html = '';

            if (data.page > 1) {                    
                prevPage = eval(data.page+'-1');
                inner_html += '<a href="#" onclick="load('+prevPage+')"  class="pagination-previous">Sebelumnya</a>'
            }

            if (data.page < data.tot_page) {
                nextPage = eval(data.page+'+1');
                inner_html += '<a href="#" onclick="load('+nextPage+')"  class="pagination-next">Selanjutnya</a>'                
            }

            inner_html += '<ul class="pagination-list">';

            for (i=data.page-5; i<=eval(data.page+'+5') ; i++) {
                if (i > 0 && i <= data.tot_page && data.tot_page > 1) {
                    if (i == data.page) {
                        inner_html += '<li><a href="#" onclick="load('+i+')" class="pagination-link is-current" aria-label="Halaman '+i+'">'+i+'</a></li>';
                    } else {
                        inner_html += '<li><a href="#" onclick="load('+i+')" class="pagination-link" aria-label="Ke halaman '+i+'">'+i+'</a></li>';                        
                    }
                }
            }

            inner_html += '</ul>';

            $('.pagination').empty();
            $('.pagination').html(inner_html);

            lists = '';

            $.each(data.data, (key, value) => {
                lists += '<div class="columns">';
                    lists += '<div class="column is-12">';                
                        lists += '<div class="tile is-ancestor">';
                            lists += '<div class="tile is-parent is-12">';
                                lists += '<article class="tile is-child box">';
                                    lists += '<p class="title is-6">';
                                        lists += '<a href="courses/detail/'+value.id+'">'+value.title+'</a>';
                                    lists += '</p>';
                                    lists += '<p class="subtitle is-6">Dibuat pada:'+value.created_at+'</p>'; 
                                    
                                    lists += '<div class="content">'
                                        lists += '<p>'+value.description+'</p>';
                                    lists += '</div">'

                                    lists += '<nav class="level">';
                                        lists += '<div class="level-left"></div>';
                                        lists += '<div class="level-right">';
                                            lists += '<div class="level-item"><a class="button is-primary" href="courses/update/'+value.id+'">Ubah</a></div>';
                                            lists += '<div class="level-item"><a class="button is-danger" href="courses/delete/'+value.id+'">Hapus</a></div>';                                    
                                        lists += '</div';                                
                                    lists += '</nav>';
                                    
                                lists += '</article>';                    
                            lists += '</div>';                
                        lists += '</div>';
                    lists += '</div>';            
                lists += '</div>';                                                
            });


            setTimeout(() => {
                $('#dosen_courses').html();
                $('#dosen_courses').html(lists);
            }, 1000);
        }

    }).fail((err) => {
        console.log('Dosen Courses Err');
    });
}

List.prototype.allCourses = function(page, url) {
    search = 0;
    link = this.url[0] + '/' + page + "/" + 4 + "/" + search;

    page_now = page;

    $('#all_courses').html();
    $('#all_courses').html('<p><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Mohon tunggu...</p>');

    $.ajax({
        url : link,
        dataType: 'json',
    }).done((data) => {

        if (data.tot_page == 0) {
            $('#all_courses').html('<p>Daftar materi kosong.</p>');
        } else {
            inner_html = '';

            if (data.page > 1) {                    
                prevPage = eval(data.page+'-1');
                inner_html += '<a href="#" onclick="load('+prevPage+')"  class="pagination-previous">Sebelumnya</a>'
            }

            if (data.page < data.tot_page) {
                nextPage = eval(data.page+'+1');
                inner_html += '<a href="#" onclick="load('+nextPage+')"  class="pagination-next">Selanjutnya</a>'                
            }

            inner_html += '<ul class="pagination-list">';

            for (i=data.page-5; i<=eval(data.page+'+5') ; i++) {
                if (i > 0 && i <= data.tot_page && data.tot_page > 1) {
                    if (i == data.page) {
                        inner_html += '<li><a href="#" onclick="load('+i+')" class="pagination-link is-current" aria-label="Halaman '+i+'">'+i+'</a></li>';
                    } else {
                        inner_html += '<li><a href="#" onclick="load('+i+')" class="pagination-link" aria-label="Ke halaman '+i+'">'+i+'</a></li>';                        
                    }
                }
            }

            inner_html += '</ul>';

            $('.pagination').empty();
            $('.pagination').html(inner_html);

            lists = '';

            $.each(data.data, (key, value) => {
                lists += '<div class="columns">';
                    lists += '<div class="column is-12">';                
                        lists += '<div class="tile is-ancestor">';
                            lists += '<div class="tile is-parent is-12">';
                                lists += '<article class="tile is-child box">';
                                    lists += '<p class="title is-6">';
                                        lists += '<a href="courses/detail/'+value.id+'">'+value.title+'</a>';
                                    lists += '</p>';
                                    lists += '<p class="subtitle is-6">Oleh: '+value.name+', Dibuat pada:'+value.created_at+'</p>'; 
                                    
                                    lists += '<div class="content">'
                                        lists += '<p>'+value.description+'</p>';
                                    lists += '</div">';
                                    
                                lists += '</article>';                    
                            lists += '</div>';                
                        lists += '</div>';
                    lists += '</div>';            
                lists += '</div>';                                                
            });


            setTimeout(() => {
                $('#all_courses').html();
                $('#all_courses').html(lists);
            }, 1000);
        }

    }).fail((err) => {
        console.log('Dosen Courses Err');
    });

}