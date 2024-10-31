<div class="entry_actions clr">
    <div class="clr"></div>
    <div class="left_actions rate_[%aggregatelikecount%]">
        <a href="#" onclick="addClass(findParentNode('entry',this),'rate_detail');return false;" class="sotial_rate default">[%aggregatelikecount%]</a>
        <span class="close" onclick="removeClass(findParentNode('entry',this),'rate_detail');return false;"> </span>
    </div>
    <div class="right_actions">
              <ul class="entrySocialActions">
                  <li class="facebook-root">
                  <a href="http://www.facebook.com/sharer.php?t=[%titleUrl%]&amp;u=[%url%]" target="_blank"> </a>
                </li>
                  <li class="linkedin-root">
                  <a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=[%titleUrl%]&amp;url=[%url%]" target="_blank"> </a>
                </li>
                <li class="twitter-root">
                  <a href="http://twitter.com/share?text=[%titleUrl%]&amp;url=[%url%]&amp;count=none" target="_blank"> </a>
                </li>
                
                
              </ul>
            </div>
    <div class="rate_breakdown">
        <table style="width: 100%;">
            <tr>
                <td class="fb_bd_text">
                    <span class="ds">Social Rank Breakdown: [%aggregatelikecount%]</span>
                    <span class="eqil">=</span>
                </td>
                <td class="fb_db_num rate_[%totallikecount%]">
                    <span class="fb_rate">[%totallikecount%]</span>
                </td>
                <td class="fb_db_num rate_[%retweetcount%]">
                    <span class="retweetcount_rate">[%retweetcount%]</span>
                </td>
                <td class="fb_db_num rate_[%youtubelikecount%]">
                    <span class="youtube_rate">[%youtubelikecount%]</span>
                </td>
                <td class="fb_db_num rate_[%linkedin%]">
                    <span class="linkedin_rate">[%linkedin%]</span>
                </td>
                <td class="fb_db_num rate_[%google%]">
                    <span class="google_rate">[%google%]</span>
                </td>
                <td class="fb_db_num rate_[%pinterest%]">
                    <span class="pinterest_rate">[%pinterest%]</span>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="clr"></div>
</div>
