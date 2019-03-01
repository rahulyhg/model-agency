<?php
/**
 * @var $this \yii\web\View
 */
use yii\helpers\Url;
?>
<aside class="b-sidebar b-page__sidebar">
  <div class="b-sidebar__inner">
    <header class="b-sidebar__header">
      <div class="b-logo b-sidebar__logo">
        <a class="b-logo__link" href="<?= Url::to(['/']) ?>">
          <svg class="b-logo__svg" version="1.1" id="sidebar-logo" xmlns="http://www.w3.org/2000/svg"
               xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1523.6 1066.3"
               style="enable-background:new 0 0 1523.6 1066.3;" xml:space="preserve">
                  <style type="text/css">.b-logo__svg-path-1 {
                      fill: url(#sidebar-logo-gradient-1);
                    }

                    .b-logo__svg-path-2 {
                      fill: url(#sidebar-logo-gradient-2);
                    }

                    .b-logo__svg-path-3 {
                      fill: url(#sidebar-logo-gradient-3);
                    }

                    .b-logo__svg-path-4 {
                      fill: url(#sidebar-logo-gradient-4);
                    }

                    .b-logo__svg-path-5 {
                      fill: url(#sidebar-logo-gradient-5);
                    }
                  </style>
            <g>
              <g>
                <lineargradient id="sidebar-logo-gradient-1" gradientUnits="userSpaceOnUse" x1="362.8997"
                                y1="294.8716" x2="762.9669" y2="294.8716"
                                gradientTransform="matrix(0.998 -6.399141e-02 6.399141e-02 0.998 -23.3165 25.7983)">
                  <stop offset="0" style="stop-color:#DD0A00"></stop>
                  <stop offset="0.151" style="stop-color:#E01304"></stop>
                  <stop offset="0.402" style="stop-color:#E72D0F"></stop>
                  <stop offset="0.72" style="stop-color:#F25620"></stop>
                  <stop offset="0.9944" style="stop-color:#FE7F32"></stop>
                </lineargradient>
                <path class="b-logo__svg-path-1"
                      d="M396.7,0c12.8,22,25.5,44,38.3,66c26.1,44.9,52.3,89.7,78.3,134.7c1.9,3.2,4,4.9,7.8,5.6                        c76.3,14.1,152.6,28.3,228.9,42.4c0.9,0.2,1.8,0.3,2.7,0.5c1.1,0.3,2.6,0,2.9,1.4c0.3,1.2-1.1,1.7-1.8,2.4                        c-19.2,17.8-38.5,35.7-57.7,53.5c-46,42.6-92.1,85.2-138.1,127.9c-9.9,9.2-8.3,5-6.7,18.2c3.5,27.5,6.8,55.1,10.3,82.7                        c1.7,13.3,3.4,26.6,5.2,39.9c0.1,0.9,0.6,1.9-0.4,2.5c-0.8,0.5-1.5-0.1-2.2-0.5c-16.1-8.6-32.2-17.3-48.3-25.9                        c-1.7-0.9-2.4-2.2-2.6-4c-2.2-17.9-4.4-35.7-6.7-53.6c-2.9-22.2-5.7-44.5-8.8-66.7c-0.5-3.6,0.3-6.1,3-8.6                        c48.5-45.1,97-90.3,145.5-135.5c0.8-0.7,2.3-1.3,1.8-2.7c-0.4-0.9-1.8-0.8-2.8-1c-52.1-9.5-104.2-19-156.3-28.3                        c-3.8-0.7-6.1-2.3-8.1-5.7c-28.7-48.9-57.6-97.8-86.5-146.6C376.6,68.5,358.8,38.4,341,8.3c-0.8-1.4-2.1-2.7-2.1-4.6                        C358.2,2.5,377.5,1.2,396.7,0z"></path>
                <lineargradient id="sidebar-logo-gradient-2" gradientUnits="userSpaceOnUse" x1="3.5096" y1="176.0379"
                                x2="622.2537" y2="176.0379"
                                gradientTransform="matrix(0.998 -6.399141e-02 6.399141e-02 0.998 -23.3165 25.7983)">
                  <stop offset="0" style="stop-color:#DD0A00"></stop>
                  <stop offset="0.151" style="stop-color:#E01304"></stop>
                  <stop offset="0.402" style="stop-color:#E72D0F"></stop>
                  <stop offset="0.72" style="stop-color:#F25620"></stop>
                  <stop offset="0.9944" style="stop-color:#FE7F32"></stop>
                </lineargradient>
                <path class="b-logo__svg-path-2"
                      d="M0,334.6C3.2,324,5.2,313,7.9,302.3c1.5-5.8,2.8-11.7,4-17.5c0.5-2.6,1.8-4,4.5-4.7                        c36.3-8.6,72.5-17.2,108.8-25.9c36-8.6,72-17.2,108-25.7c2.7-0.6,3.8-2.3,4.8-4.6c7.7-18.1,15.5-36.2,23.3-54.3                        c21.8-50.8,43.6-101.7,65.4-152.5c0.6-1.3,0.7-3.2,2.2-3.5c1.7-0.3,2,1.7,2.7,2.9c42.4,72.9,84.9,145.9,127.3,218.9                        c4.5,7.7,9,15.3,13.3,23c1.3,2.2,2.9,3.4,5.5,3.8c44.4,8.2,88.7,16.4,133.1,24.6c2.2,0.4,5.6-0.1,6.3,2.1c0.7,2-2.4,3.3-3.9,4.8                        c-11.8,11.5-23.6,22.8-35.4,34.3c-1.9,1.9-3.8,2.2-6.4,1.8c-37.8-7-75.7-13.9-113.5-20.9c-0.8-0.1-1.5-0.4-2.3-0.4                        c-10.8,0.1-16.4-6-21.6-15c-29.3-51.1-59.4-101.9-89.2-152.7c-3.2-5.5-6.5-10.9-9.8-16.4c-1.7,0.8-1.8,2.4-2.3,3.6                        c-19.5,45.9-39,91.7-58.3,137.6c-1.7,3.9-3.8,6.1-8.2,7.1c-64.6,15.7-129.2,31.6-193.7,47.4c-24.1,5.9-48.1,11.8-72.2,17.6                        C0.1,336.7,0.1,335.6,0,334.6z"></path>
                <lineargradient id="sidebar-logo-gradient-3" gradientUnits="userSpaceOnUse" x1="274.3415"
                                y1="497.9149" x2="786.5096" y2="497.9149"
                                gradientTransform="matrix(0.998 -6.399141e-02 6.399141e-02 0.998 -23.3165 25.7983)">
                  <stop offset="0" style="stop-color:#DD0A00"></stop>
                  <stop offset="0.151" style="stop-color:#E01304"></stop>
                  <stop offset="0.402" style="stop-color:#E72D0F"></stop>
                  <stop offset="0.72" style="stop-color:#F25620"></stop>
                  <stop offset="0.9944" style="stop-color:#FE7F32"></stop>
                </lineargradient>
                <path class="b-logo__svg-path-3"
                      d="M783.2,313.4c-15.8,14.8-31.6,29.6-47.5,44.3c-38.8,36-77.7,72.1-116.5,108c-1.9,1.7-2.4,3.5-2.1,5.9                        c2.4,18.7,4.9,37.5,7.3,56.2c1.9,14.6,3.6,29.2,5.4,43.9c2.4,19.1,4.9,38.3,7.3,57.4c1.8,14,3.5,27.9,5.2,41.9                        c1,7.6,2,15.3,2.9,22.9c0.1,1.2,0.9,2.8-0.5,3.6c-1.2,0.7-2.2-0.5-3.2-1c-49.5-28-99.1-55.9-148.6-83.9                        c-28.3-16-56.6-31.9-84.9-47.9c-2.6-1.5-4.6-1.4-7.2,0c-35,19.3-70,38.4-105,57.6c-0.6,0.3-1.1,0.7-1.7,0.9                        c-1.2,0.5-2.3,1.9-3.5,1.1c-1.4-0.8-0.4-2.4-0.3-3.6c2-17.4,4.1-34.7,6-52.1c0.3-3,2.1-4.2,4.3-5.4c32.8-18,65.7-36,98.3-54.3                        c5.1-2.9,8.7-2.8,13.8,0.1c55.9,31.6,111.9,62.9,167.9,94.2c1,0.5,2,1.9,3.1,1c1-0.8,0.3-2.2,0.2-3.3c-4.1-31.7-8.2-63.3-12.4-95                        c-2.3-17.4-4.6-34.9-7.1-52.3c-0.6-4.1,0.7-6.8,3.6-9.5c31.7-29.7,63.4-59.4,95-89.2c33.3-31.3,66.6-62.5,99.8-93.8                        c4.1-3.9,4.3-3.9,6,1.6c4.2,14.1,8.3,28.3,12.4,42.4c0.4,1.5,1.1,2.9,1.6,4.4C783.1,310.8,783.2,312.1,783.2,313.4z"></path>
                <lineargradient id="sidebar-logo-gradient-4" gradientUnits="userSpaceOnUse" x1="145.8308"
                                y1="556.0057" x2="619.1892" y2="556.0057"
                                gradientTransform="matrix(0.998 -6.399141e-02 6.399141e-02 0.998 -23.3165 25.7983)">
                  <stop offset="0" style="stop-color:#DD0A00"></stop>
                  <stop offset="0.151" style="stop-color:#E01304"></stop>
                  <stop offset="0.402" style="stop-color:#E72D0F"></stop>
                  <stop offset="0.72" style="stop-color:#F25620"></stop>
                  <stop offset="0.9944" style="stop-color:#FE7F32"></stop>
                </lineargradient>
                <path class="b-logo__svg-path-4"
                      d="M592.7,743c-26.6-15-53.1-30.1-79.7-45.1c-35.1-19.8-70.3-39.6-105.3-59.5c-3.7-2.1-6.5-2.2-10.4-0.1                        c-61.6,33.9-123.3,67.7-184.9,101.4c-0.6,0.3-1.1,0.7-1.7,0.9c-0.9,0.4-1.9,1.3-2.9,0.6c-1-0.7-0.4-1.9-0.3-2.9                        c3.1-22.6,6.2-45.2,9.4-67.8c9.2-66.1,18.5-132.2,27.8-198.3c0.4-3.1-0.4-5-2.8-7c-31.3-26-62.5-52.2-93.7-78.3                        c-0.9-0.8-2.6-1.4-2.2-2.9c0.3-1.5,2.1-1.3,3.3-1.6c16.9-4.4,33.8-8.7,50.7-13.2c2.5-0.7,4.2-0.1,6,1.5                        c24.4,20.5,48.8,40.9,73.2,61.3c5.6,4.7,11.2,9.4,16.8,14c2.2,1.8,2.8,3.6,2.4,6.4c-8.2,60.1-16.4,120.1-24.5,180.2                        c-0.7,4.9-1.3,9.8-1.8,14.7c-0.1,1-1,2.2,0.1,2.9c1,0.6,2-0.3,2.8-0.8c9.3-5.1,18.5-10.2,27.8-15.3c32.5-18,65.1-36,97.5-54.1                        c2.5-1.4,4.3-1.4,6.8-0.1c66.6,37.1,133.2,74,199.8,111c10.3,5.7,20.5,11.4,30.8,17.1c4.5,2.5,4.5,2.5,0.4,5.3                        c-14.3,9.8-28.7,19.5-43,29.3C594.2,742.9,593.5,743,592.7,743z"></path>
                <lineargradient id="sidebar-logo-gradient-5" gradientUnits="userSpaceOnUse" x1="8.9914" y1="441.5832"
                                x2="377.5856" y2="441.5832"
                                gradientTransform="matrix(0.998 -6.399141e-02 6.399141e-02 0.998 -23.3165 25.7983)">
                  <stop offset="0" style="stop-color:#DD0A00"></stop>
                  <stop offset="0.151" style="stop-color:#E01304"></stop>
                  <stop offset="0.402" style="stop-color:#E72D0F"></stop>
                  <stop offset="0.72" style="stop-color:#F25620"></stop>
                  <stop offset="0.9944" style="stop-color:#FE7F32"></stop>
                </lineargradient>
                <path class="b-logo__svg-path-5"
                      d="M113.9,376.2c10.1,8.5,19.7,16.5,29.3,24.5c18.9,15.7,37.7,31.3,56.6,47c9,7.5,18,15.1,27.2,22.4                        c2.4,2,3.2,4,2.8,7c-5.4,40.3-10.8,80.6-16.1,121c-6.1,46.5-12.2,93.1-18.3,139.6c-0.1,1-0.3,2.1-0.5,3.1                        c-0.3,2.1-1.3,2.3-2.9,1.2c-14.6-10-29.3-20.1-43.9-30.1c-1.8-1.2-1.6-2.7-1.4-4.5c2.8-20.3,5.6-40.6,8.4-60.8                        C162.1,596.4,169,546.2,176,496c0.3-2.4-0.2-3.8-2-5.4c-21.8-18.2-43.6-36.5-65.4-54.8c-32.6-27.3-65.2-54.6-97.9-81.9                        c-0.9-0.8-1.8-1.5-2.7-2.3c-0.7-0.6-1.8-1.1-1.5-2.1c0.3-1.2,1.6-1.2,2.5-1.5c7.7-1.9,15.5-3.7,23.2-5.5                        c38.3-9.1,76.6-18.2,114.9-27.3c43.1-10.3,86.2-20.6,129.4-30.7c3.3-0.8,5.1-2.3,6.4-5.4c17-39.7,34.2-79.3,51.4-118.9                        c0.6-1.3,0.7-3.3,2.2-3.4c1.5-0.1,2,1.9,2.7,3c8.6,14.3,17.2,28.6,25.9,42.9c1.7,2.8,2.1,5.2,0.7,8.4                        c-16.1,37.5-32.2,75.1-48.2,112.6c-1,2.5-2.6,3.6-5.1,4.2c-53.7,12.9-107.5,25.9-161.2,38.8c-11.7,2.8-23.3,5.7-35,8.5                        C115.8,375.4,115.2,375.7,113.9,376.2z"></path>
              </g>
              <g>
                <path
                  d="M108.3,1066.3c-31.1,0-56.9-9.5-77.4-28.5C10.3,1018.8,0,994.4,0,964.5c0-30.1,10.2-54.6,30.7-73.5                        c20.5-18.9,46.3-28.3,77.6-28.3c23.6,0,42.6,5.5,57.1,16.5c14.5,11,25.2,24.6,32.3,40.7l-51.3,23.9c-2.6-7.9-7.4-14.6-14.5-20.2                        s-14.9-8.4-23.6-8.4c-14.2,0-25.7,4.7-34.5,14.2s-13.3,21.1-13.3,35.1c0,14,4.4,25.7,13.3,35.1s20.4,14.2,34.5,14.2                        c8.7,0,16.5-2.8,23.6-8.4s11.9-12.3,14.5-20.2l51.3,23.6c-3.1,7.3-7.1,14-11.8,20.2c-4.7,6.2-10.6,12.2-17.7,18.1                        s-15.8,10.6-26.1,14C131.7,1064.6,120.4,1066.3,108.3,1066.3z"></path>
                <path
                  d="M284.7,1066.3c-22.8,0-41.7-6.8-56.8-20.4c-15-13.6-22.6-31.8-22.6-54.6c0-21,7.3-38.7,21.8-53.1                        c14.6-14.4,33.1-21.5,55.8-21.5c21.4,0,39.1,7.2,53.1,21.7c14,14.5,20.9,34,20.9,58.6v10.9h-96.8c1.6,4.9,5,9.1,10.3,12.7                        c5.3,3.5,12.1,5.3,20.4,5.3c4.5,0,10.3-1,17.3-2.9c7-2,12.1-4.3,15.5-7.1l21.8,32.7c-6.7,5.7-15.6,10.1-26.8,13.1                        C307.4,1064.8,296.1,1066.3,284.7,1066.3z M306.5,974.2c-2.8-11.4-10.6-17.1-23.6-17.1c-12.4,0-20.2,5.7-23.3,17.1H306.5z"></path>
                <path d="M428.3,1062.7h-53.1V866h53.1V1062.7z"></path>
                <path
                  d="M527.4,1066.3c-22.8,0-41.7-6.8-56.8-20.4c-15-13.6-22.6-31.8-22.6-54.6c0-21,7.3-38.7,21.8-53.1                        c14.6-14.4,33.1-21.5,55.8-21.5c21.4,0,39.1,7.2,53.1,21.7c14,14.5,20.9,34,20.9,58.6v10.9h-96.8c1.6,4.9,5,9.1,10.3,12.7                        c5.3,3.5,12.1,5.3,20.4,5.3c4.5,0,10.3-1,17.3-2.9c7-2,12.1-4.3,15.5-7.1l21.8,32.7c-6.7,5.7-15.6,10.1-26.8,13.1                        C550.1,1064.8,538.8,1066.3,527.4,1066.3z M549.3,974.2c-2.8-11.4-10.6-17.1-23.6-17.1c-12.4,0-20.2,5.7-23.3,17.1H549.3z"></path>
                <path
                  d="M671.1,1062.7H618V866h53.1v69.3c10.2-12.4,23.6-18.6,40.1-18.6c18.1,0,33.1,6.7,45,20.1c11.9,13.4,17.8,31.6,17.8,54.6                        c0,23.6-6,42-17.8,55.2c-11.9,13.2-26.9,19.8-45,19.8c-15.7,0-29.1-6.2-40.1-18.6V1062.7z M671.1,1009.9                        c5.1,6.3,12.5,9.4,22.1,9.4c7.5,0,13.8-2.5,18.9-7.5c5.1-5,7.7-11.8,7.7-20.5c0-8.5-2.6-15.2-7.7-20.2c-5.1-5-11.4-7.5-18.9-7.5                        c-9.4,0-16.8,3.2-22.1,9.7V1009.9z"></path>
                <path
                  d="M895.3,1066.3c-28.7,0-52.8-9.5-72.1-28.5c-19.4-19-29.1-43.4-29.1-73.3c0-29.9,9.7-54.3,29.1-73.3                        c19.4-19,43.4-28.5,72.1-28.5c31.5,0,56.3,13,74.6,38.9l-20.6,11.5c-5.7-8.5-13.4-15.3-23-20.6c-9.6-5.3-20-8-31-8                        c-21.6,0-39.7,7.5-54.1,22.6c-14.5,15-21.7,34.2-21.7,57.4c0,23.2,7.2,42.3,21.7,57.4c14.5,15,32.5,22.6,54.1,22.6                        c11,0,21.3-2.6,31-7.8c9.6-5.2,17.3-12.1,23-20.8l20.9,11.5C951.1,1053.3,926.1,1066.3,895.3,1066.3z"></path>
                <path d="M1022.7,1062.7h-22.1V866h22.1V1062.7z"></path>
                <path
                  d="M1180.4,1044.7c-12.9,14.4-29.9,21.5-51.2,21.5c-21.2,0-38.3-7.2-51.2-21.5c-12.9-14.4-19.3-32.2-19.3-53.4                        c0-21.2,6.4-39,19.3-53.2c12.9-14.3,29.9-21.4,51.2-21.4c21.2,0,38.3,7.1,51.2,21.4c12.9,14.3,19.3,32,19.3,53.2                        C1199.7,1012.6,1193.2,1030.4,1180.4,1044.7z M1094.5,1030.4c8.6,10.7,20.1,16.1,34.7,16.1c14.6,0,26.1-5.4,34.5-16.1                        c8.5-10.7,12.7-23.7,12.7-39.1s-4.2-28.3-12.7-38.9c-8.5-10.6-20-15.9-34.5-15.9c-14.6,0-26.1,5.4-34.7,16.1                        c-8.6,10.7-12.8,23.6-12.8,38.8C1081.7,1006.7,1086,1019.7,1094.5,1030.4z"></path>
                <path
                  d="M1354,1062.7h-22.1v-20.1c-5.9,6.7-13.3,12.3-22.3,16.8c-9,4.5-18.4,6.8-28.5,6.8c-30.3,0-45.4-15.1-45.4-45.4V920.3h22.1                        v93.8c0,11.8,2.7,20.2,8.1,25.1c5.4,4.9,13.3,7.4,23.7,7.4c8.3,0,16.3-2.1,24-6.2c7.8-4.1,13.8-9.2,18.1-15.3V920.3h22.1V1062.7z"></path>
                <path
                  d="M1523.6,1062.7h-22.1v-21.2c-12.2,16.5-28.2,24.8-48.1,24.8c-18.9,0-34.2-6.7-45.9-20.2c-11.7-13.5-17.6-31.6-17.6-54.4                        c0-22.6,5.8-40.8,17.6-54.4c11.7-13.7,27-20.5,45.9-20.5c19.7,0,35.7,8.4,48.1,25.1V866h22.1V1062.7z M1458.7,1046.5                        c8.7,0,16.9-2.2,24.8-6.5c7.9-4.3,13.9-9.6,18-15.9v-64.6c-4.1-6.5-10.2-11.9-18.1-16.4c-8-4.4-16.2-6.6-24.6-6.6                        c-14,0-25.1,5.2-33.3,15.5c-8.3,10.3-12.4,23.6-12.4,39.7c0,16.1,4.1,29.3,12.4,39.5C1433.6,1041.4,1444.7,1046.5,1458.7,1046.5z"></path>
              </g>
            </g>
                </svg>
        </a>
      </div>
    </header>
    <nav class="b-menu b-sidebar__menu">
      <ul class="b-menu__items">
        <li class="b-menu__item <?= $this->params['active_nav_item'] === 'home' ? 'b-menu__item_active' : '' ?>">
          <a class="b-menu__item-link" href="<?= Url::to(['/']) ?>">Главная</a>
        </li>
        <li class="b-menu__item <?= $this->params['active_nav_item'] === 'our_models' ? 'b-menu__item_active' : '' ?>">
          <a class="b-menu__item-link" href="<?= Url::to(['/mod/model/index']) ?>">Наши модели</a>
        </li>
        <li class="b-menu__item <?= $_SERVER['REQUEST_URI'] === '/site/contact' ? 'b-menu__item_active' : '' ?>"><a class="b-menu__item-link" href="<?= Url::to(['/site/contact']) ?>">Контакты</a></li>
      </ul>
    </nav>
    <footer class="b-sidebar__footer">
      <div class="b-social b-sidebar__social">
        <ul class="b-social__items">
          <li class="b-social__item"><a class="b-social__item-link" href="#" title="our vk"><i
                class="b-social__item-icon fab fa-vk"></i></a></li>
          <li class="b-social__item"><a class="b-social__item-link" href="#" title="our facebook"><i
                class="b-social__item-icon fab fa-facebook-f"></i></a></li>
          <li class="b-social__item"><a class="b-social__item-link" href="#" title="our twitter"><i
                class="b-social__item-icon fab fa-twitter"></i></a></li>
          <li class="b-social__item"><a class="b-social__item-link" href="#" title="our instagram"><i
                class="b-social__item-icon fab fa-instagram"></i></a></li>
          <li class="b-social__item"><a class="b-social__item-link" href="#" title="our instagram">
              <img src="<?= Yii::$app->theme->getAssetsUrl($this) ?>//img/18-plus.png"></a></li>
        </ul>
      </div>
      <p class="b-sidebar__copyright">© Model Agency "Celeb Cloud", 2018</p>
    </footer>
  </div>
</aside>
