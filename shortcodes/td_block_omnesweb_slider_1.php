<?php
// v3 - for wp_010

class td_block_omnesweb_slider_1 extends td_block {


    function render($atts, $content = null) {
        // for big grids, extract the td_grid_style
        extract(shortcode_atts(
            array(
                'td_grid_style' => 'td-grid-style-1'
            ), $atts));

        if ( empty( $atts ) ) {
            $atts = array();
        }
        $atts['limit'] = 4;
        $atts['thumbnail'] = 1;
        $atts['td_grid_style'] = 'td-grid-style-3';

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        $buffy = '';

        $buffy .= '<div class="td_block_big_grid_politic td_block_big_grid_3 ' . $this->get_block_classes(array('td-hover-1 td-big-grids')) . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();


        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        $buffy .= $this->inner($this->td_query->posts, $this->get_att('item_height')); //inner content of the block
        $buffy .= '<div class="clearfix"></div>';
        $buffy .= '</div>';

        $buffy .= '<script type="text/javascript">td_blocks_omnesweb_slider_1("'.$this->block_uid.'");</script>';

        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $item_height) {

        $buffy = '';

        $buffy .= '
        <div class="td_block_omnesweb_slider_1">
            <div class="td_block_omnesweb_slider_1_items" style="height: '.$item_height.'">';

            $i=1;
            foreach($posts as $post) {
                $thumb = get_the_post_thumbnail_url($post->ID);
                $buffy .= '<div class="item" style="background-image:url('.$thumb.'); height: '.$item_height.'">';
                $buffy .= '<a class="permalink" href="'.get_permalink($post->ID).'"></a>';
                    $buffy .= '<div class="sombra"></div>';   
                    $buffy .= '<div class="container-title">';
                        $buffy .= '<div class="retranca">'.get_post_meta($post->ID, 'retranca', true).'RETRANCA</div>';
                        $buffy .= '<div class="title">'.$post->post_title.'</div>';
                    $buffy .= '</div>';
                    
                $buffy .= '</div>';
                $i++;
            }

        $buffy .= 
            '</div>
            <div class="pagination">
                <ul>
                    <li ref="0" class="current">1</a>
                    <li ref="1">2</a>
                    <li ref="2">3</a>
                    <li ref="3">4</a>
                </ul>
            </div>
        </div>';

        return $buffy;

    }
}