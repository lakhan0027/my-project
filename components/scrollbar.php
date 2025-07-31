<?php
function renderScrollbar($content, $height = "200px", $width = "100%") {
    echo <<<HTML
    <style>
        .custom-scrollbar {
            width: $width;
            height: $height;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding-top: 20px;
            box-sizing: border-box;
        }

        /* Custom scrollbar styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive overrides */
        @media (max-width: 768px) {
            .custom-scrollbar {
                height: 90vh;
                width: 100%;
            }
        }
        @media (max-width: 500px) {
            .custom-scrollbar {
                height: 80vh;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .custom-scrollbar {
                height: 76vh;
                width: 100%;
                margin-top: 20px;
            }
        }
    </style>

    <div class="custom-scrollbar">
        $content
    </div>
    HTML;
}
?>
