<? /** @var $block array */?>
<div class="itsharing">
    <div class="container">
        <div class="itsharing__wrap">
            <div class="itsharing__title"><?=$block['text']['value']?></div>
            <div class="itsharing__list">
                <button class="itsharing__link" id="shareTwitter">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2802_13301)">
                            <path d="M16.4284 20.3438H3.57158C1.59814 20.3438 0 18.7456 0 16.7722V3.91533C0 1.94189 1.59814 0.34375 3.57158 0.34375H16.4284C18.4019 0.34375 20 1.94189 20 3.91533V16.7722C20 18.7456 18.4019 20.3438 16.4284 20.3438Z" fill="#1A1A1A"/>
                            <path d="M4.67188 13.6901C5.63751 14.31 6.78868 14.6726 8.02418 14.6726C12.0849 14.6726 14.3746 11.2444 14.2397 8.17038C14.6656 7.86256 15.0366 7.47883 15.3318 7.04029C14.9396 7.21318 14.518 7.33125 14.0752 7.38607C14.5264 7.11619 14.8722 6.68609 15.0366 6.17586C14.6149 6.42465 14.1469 6.61019 13.6493 6.70717C13.2487 6.28128 12.6837 6.01562 12.0554 6.01562C10.6428 6.01562 9.60546 7.33125 9.92593 8.70169C8.10852 8.60892 6.49772 7.74027 5.41824 6.41622C4.84476 7.39872 5.12307 8.68482 6.09292 9.3342C5.73449 9.32155 5.39715 9.22456 5.10198 9.06011C5.07668 10.0721 5.80618 11.0209 6.85615 11.2317C6.54832 11.3161 6.21099 11.3329 5.86943 11.2697C6.14773 12.1383 6.95313 12.7708 7.91033 12.7877C6.98687 13.5046 5.83148 13.8292 4.67188 13.6901Z" fill="white"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_2802_13301">
                                <rect width="20" height="20" fill="white" transform="translate(0 0.34375)"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <button class="itsharing__link" id="shareLinkedIn">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2802_13305)">
                            <path d="M18.5195 0.34375H1.47656C0.660156 0.34375 0 0.988281 0 1.78516V18.8984C0 19.6953 0.660156 20.3438 1.47656 20.3438H18.5195C19.3359 20.3438 20 19.6953 20 18.9023V1.78516C20 0.988281 19.3359 0.34375 18.5195 0.34375ZM5.93359 17.3867H2.96484V7.83984H5.93359V17.3867ZM4.44922 6.53906C3.49609 6.53906 2.72656 5.76953 2.72656 4.82031C2.72656 3.87109 3.49609 3.10156 4.44922 3.10156C5.39844 3.10156 6.16797 3.87109 6.16797 4.82031C6.16797 5.76562 5.39844 6.53906 4.44922 6.53906ZM17.043 17.3867H14.0781V12.7461C14.0781 11.6406 14.0586 10.2148 12.5352 10.2148C10.9922 10.2148 10.7578 11.4219 10.7578 12.668V17.3867H7.79688V7.83984H10.6406V9.14453H10.6797C11.0742 8.39453 12.043 7.60156 13.4844 7.60156C16.4883 7.60156 17.043 9.57812 17.043 12.1484V17.3867Z" fill="#1A1A1A"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_2802_13305">
                                <rect y="0.34375" width="20" height="20" rx="3" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('shareTwitter').onclick = function() {
        shareOnTwitter();
    };

    document.getElementById('shareLinkedIn').onclick = function() {
        shareOnLinkedIn();
    };

    function shareOnTwitter() {
        let url = encodeURIComponent(document.URL);
        let text = encodeURIComponent(document.title);
        let shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`;
        openInNewTab(shareUrl);
    }

    function shareOnLinkedIn() {
        let url = encodeURIComponent(document.URL);
        let title = encodeURIComponent(document.title);
        let shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`;
        openInNewTab(shareUrl);
    }

    function openInNewTab(url) {
        let win = window.open(url, '_blank');
        win.focus();
    }
</script>