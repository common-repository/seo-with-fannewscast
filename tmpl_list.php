<div id="[%varprefix%]_content" class="fnc_content">
    [%tmplSearch%]
    <div>
      <table>
        <tr>
          <td>[%tmplSort%]</td>
        </tr>
      </table>
    </div>
    <div class="pagination" [%paginationAttrs%]>
        <table>
            <tr>
                <td><p>[%entriesSlice%] of [%totalEntries%]</p></td>
                <td>
                    <table class="pagination-inner">
                        <tr class="[%pagerStateClass%]">
                            <td class="pager-first"><a href="[%firstPageUrl%]">first</a></td>
                            <td class="pager-previous-label"><a href="[%prevPageUrl%]">prev</a></td>
                            <td class="pager-list-dots-left">...</td>
                            <td class="pager-current"><span>[%curPage%]</span></td>
                            <td class="pager-list-dots-right">...</td>
                            <td class="pager-next-label"><a href="[%nextPageUrl%]">next</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="clr"></div>
    <div id="fnc_list">
        [%list%]
    </div>
    <div class="pagination" [%paginationAttrs%]>
        <table>
            <tr>
                <td><p>[%entriesSlice%] of [%totalEntries%]</p></td>
                <td>
                    <table class="pagination-inner">
                        <tr class="[%pagerStateClass%]">
                            <td class="pager-first"><a href="[%firstPageUrl%]">first</a></td>
                            <td class="pager-previous-label"><a href="[%prevPageUrl%]">prev</a></td>
                            <td class="pager-list-dots-left">...</td>
                            <td class="pager-current"><span>[%curPage%]</span></td>
                            <td class="pager-list-dots-right">...</td>
                            <td class="pager-next-label"><a href="[%nextPageUrl%]">next</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="clr"></div>
  [%ajax%]
<script type="text/javascript">

 function hasClass(ele,cls) {
	return ele.className.match(new RegExp('(\\\\s|^)'+cls+'(\\\\s|$)'));
}
function addClass(ele,cls) {
	if (!this.hasClass(ele,cls)) ele.className += " "+cls;
}
function removeClass(ele,cls) {
	if (hasClass(ele,cls)) {
		var reg = new RegExp('(\\\\s|^)'+cls+'(\\\\s|$)');
		ele.className=ele.className.replace(reg,' ');
	}
}
function findParentNode(parentClass, childObj) {
    var testObj = childObj.parentNode;
    var count = 1;
    while(!hasClass(testObj, parentClass)) {
        testObj = testObj.parentNode;
        count++;
    }
    return testObj;
}
</script>
</div>