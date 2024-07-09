<style>
    .tab-content {
	  display: none;
	}

	#home-tab-sec > .tab-content:first-of-type {
	  display: block;
	}

</style>

<div id="home-tab-sec" class="wrap">
    <h1>Jsun WP Plugin Admin</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active">REST API Paths</a>
        <a href="#tab2" class="nav-tab">Other Tab</a>
    </h2>
    <div id="tab1" class="tab-content">
        <h2>REST API Paths</h2>
        <ul>
            <?php 
            $base_url = home_url('/wp-json/' . $this->plugin_name . '/v1');
            foreach ($plugin_routes as $route): 
                $full_path = esc_url($base_url . $route['path']);
            ?>
                <li>
                    <input type="text" readonly value="<?php echo $full_path; ?>" onclick="this.select();" />
                    <button onclick="copyToClipboard('<?php echo $full_path; ?>')">Copy</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="tab2" class="tab-content">
        <h2>Other Content</h2>
        <p>Other content goes here.</p>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function($) {
        $('.nav-tab').click(function(event) {
            event.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.tab-content').hide();
            $($(this).attr('href')).show();
        });
    });

    function copyToClipboard(text) {
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert('Copied to clipboard: ' + text);
    }
</script>


