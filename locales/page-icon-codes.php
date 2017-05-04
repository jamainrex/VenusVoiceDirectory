<?php get_header();
/*
	Template Name: Icon Codes
*/
$icon_array = array('global','envelope','mail','email','letter','message','mail-envelope-closed','envelope-o','dollar','usd','keyboard_return','menu','menu2','menu3','amazon','google','google-plus','facebook','instagram','whatsapp','twitter','vine','rss','youtube','twitch','vimeo','dribbble','behance','500px','dropbox','blogger','tumblr','yahoo','appleinc','linkedin','pinterest','foursquare','yelp','html-five','user','arrow-bottom','search-2','search-3','Arrow_Forward','icon-arrow-right-c','icon-arrow-right-c2','ring','t-shirt','paris','mountains','suitcase','suitcase2','mountains2','Arrow_Forward2','Streamline-89','Streamline-94','Streamline-18','Streamline-48','Streamline-65','Streamline-58','facebook-social-media','facebook-social-media2','twitter-social-media','pinterest-social-media','youtube-social-media','trip_advisor-social-media','architecture-interior-06','user2','user22','lock2','cross','cross2','left','search4','user3','lock3','settings','circle-close','essential_set_close','heart','like_outline','location','Streamline-09','envelope2','phone','facebook_online_social_media','ExpandMore','Streamline-182','Streamline-52','Streamline-63','Streamline-75','Streamline-22','delete','Streamline-45','Streamline-44','link','social-facebook','03-twitter','33-pinterest','Location_Outline-02','phone2','phone3','phone4','mobile3','ipod','monitor','modem','window','mouse','camera2','camera3','volume','music2','broadcast','gamepad','earth','location','trashcan','cart','gift','settings','medicine','cone','key3','food','cup','drink','mug2','lollipop','car','gaspump','beer','credit-card2','device-camera','device-camera-video','device-mobile','flame','gist-secret','home4','key4','law','location2','microscope','ruby','tools','trashcan2','home','home2','home3','office','camera','headphones','music','play','film','video-camera','dice','pacman','bullhorn','connection','podcast','feed','credit-card','lifebuoy','phone','printer','display','laptop','mobile','mobile2','key','key2','wrench','aid-kit','mug','spoon-knife','fire','lab','airplane','truck','volume-high','heart','tv','sound','video','trash','key5','pen','diamond','display2','location3','clock','banknote','data','music3','megaphone','lab2','food2','t-shirt','fire2','wallet','vynil','truck2','world','key6','key7','key8','printer2','printer3','printer4','basketball','basketball2','baseball','baseball2','tennis-ball','tennis-ball2','bowling-ball','bowling-ball2','billiard-ball','billiard-ball2','soccer-ball','soccer-ball2','soccer-court','soccer-court2','football','football2','football3','football4','basketball3','basketball4','baseball-set','baseball-set2','tennis-ball3','tennis-ball4','basketball-hoop','basketball-hoop2','table-tennis','table-tennis2','volleyball','volleyball2','volleyball-water','volleyball-water2','sailing-boat','sailing-boat2','sailing-boat-water','sailing-boat-water2','bowling-pin-ball','bowling-pin-ball2','ice-skate','ice-skate2');
?>

<div class="container">
	<div class="all_icons_available">
		<ul class="clean-list single-icon">
			<?php foreach ($icon_array as $icon) : ?>
				<li><i class="icon-<?php tt_print($icon) ?>"></i><span class="the_code"><?php tt_print($icon) ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<?php get_footer(); ?>