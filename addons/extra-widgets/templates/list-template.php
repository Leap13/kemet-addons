<?php 
/**
 * Template: Social Feed List Template
 */
?>
<div class="kemet-social-feed {{? !it.moderation_passed}}hidden{{?}}" dt-create="{{=it.dt_create}}" social-feed-id = "{{=it.id}}">
    <div class='kmt-social-content'>
        <div class="kmt-author-info">
            <a class="kmt-feed-author-img" href="{{=it.author_link}}" target="_blank">
                <img class="media-object" src="{{=it.author_picture}}">
            </a>
            <span class="kmt-feed-author"><a href="{{=it.author_link}}" target="_blank">{{=it.author_name}}</a></span>
        </div>
        <div class="media-body">
            <div class="kmt-feed-content-wrap">
                <p class="kmt-feed-text">{{=it.text}} <a href="{{=it.link}}" target="_blank" class="kmt-feed-read-more">{{=it.readMore}}</a></p>
            </div>
        </div>
        {{=it.attachment}}
        <div class="kmt-feed-meta">
            <small class="muted kmt-feed-date">{{=it.time_ago}}</small>  
        </div>
    </div>
</div>