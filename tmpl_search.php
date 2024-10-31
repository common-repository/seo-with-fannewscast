<div id="search-bar" class="search-bar">
    <form action="" method="get" >
        <fieldset class="noborder">
            <input type="text" style="width: 280px" value="[%searchQuery%]" id="q"
                   onblur="if(this.value =='') this.value ='Search';"
                   onfocus="if(this.value =='Search') this.value ='';" name="[%varprefix%]_q" class="text search_text">
            <input type="image" src="[%plugin_path%]/images/search_grey.png"
                   name="sa" value="Search" id="searchButton" class="image">
            [%hiddenParams%]
            <div id="clearsearchid">
                <a href="[%clearQuery%]" title="Clear Search" class="clearsearchlink" id="clearsearchlink">
                    X
                </a>
            </div>
        </fieldset>
    </form> 
</div>
