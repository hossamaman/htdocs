<?php

//setup pagination
Pagination::set_main_tag('<ul class="pagination">', '</ul>');
Pagination::set_loop_tag('<li class="page-item :status">', '</li>');
Pagination::set_active_class('active');
Pagination::set_disabled_class('disabled');
Pagination::set_a_class('page-link');
if(strtolower(Languages::text_align()) == "right"):
    Pagination::set_next_text('<i class="fe fe-chevron-left"></i>');
    Pagination::set_prev_text('<i class="fe fe-chevron-right"></i>');
else:
    Pagination::set_next_text('<i class="fe fe-chevron-right"></i>');
    Pagination::set_prev_text('<i class="fe fe-chevron-left"></i>');
endif;
Pagination::put_status_class_on_loop(); // [<li class="active" >] instead of [<a class="active" >]

//Minify template
Template::set_minify(true);
