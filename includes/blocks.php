<?php
/**
 * Register custom blocks for the MicMol theme.
 */

defined( 'ABSPATH' ) || exit;

function micmol_register_blocks() {
    $dir = get_stylesheet_directory();
    $uri = get_stylesheet_directory_uri();

    // Editor script
    wp_register_script(
        'micmol-main-hero-editor',
        $uri . '/custom-blocks/micmol-main-hero/block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        filemtime( $dir . '/custom-blocks/micmol-main-hero/block.js' )
    );

    // Editor styles
    wp_register_style(
        'micmol-main-hero-editor-style',
        $uri . '/custom-blocks/micmol-main-hero/editor.css',
        array( 'wp-edit-blocks' ),
        filemtime( $dir . '/custom-blocks/micmol-main-hero/editor.css' )
    );

    // Frontend styles
    wp_register_style(
        'micmol-main-hero-style',
        $uri . '/custom-blocks/micmol-main-hero/style.css',
        array(),
        filemtime( $dir . '/custom-blocks/micmol-main-hero/style.css' )
    );

    $block_attributes = array(
        'titlePrimary'   => array( 'type' => 'string', 'default' => '' ),
        'titleSecondary' => array( 'type' => 'string', 'default' => '' ),
        'subtitle'       => array( 'type' => 'string', 'default' => '' ),
        'description'    => array( 'type' => 'string', 'default' => '' ),
        'primaryText'    => array( 'type' => 'string', 'default' => 'Descargar app' ),
        'primaryUrl'     => array( 'type' => 'string', 'default' => '#' ),
        'secondaryText'  => array( 'type' => 'string', 'default' => 'Ver productos' ),
        'secondaryUrl'   => array( 'type' => 'string', 'default' => '#' ),
        'imageUrl'       => array( 'type' => 'string', 'default' => '' ),
    );

    register_block_type( 'micmol/micmol-main-hero', array(
        'editor_script'   => 'micmol-main-hero-editor',
        'editor_style'    => 'micmol-main-hero-editor-style',
        'style'           => 'micmol-main-hero-style',
        'attributes'      => $block_attributes,
        'render_callback' => 'micmol_render_main_hero',
    ) );
}
add_action( 'init', 'micmol_register_blocks' );


/**
 * Server render callback for the hero block.
 * Keeps frontend markup controlled and accessible.
 */
function micmol_render_main_hero( $attributes, $content ) {
    // Attributes we expect (fallbacks applied)
    $title_primary   = isset( $attributes['titlePrimary'] ) ? $attributes['titlePrimary'] : '';
    $title_secondary = isset( $attributes['titleSecondary'] ) ? $attributes['titleSecondary'] : '';
    $subtitle        = isset( $attributes['subtitle'] ) ? $attributes['subtitle'] : '';
    $description     = isset( $attributes['description'] ) ? $attributes['description'] : '';
    $primary_text    = isset( $attributes['primaryText'] ) ? $attributes['primaryText'] : '';
    $primary_url     = isset( $attributes['primaryUrl'] ) ? $attributes['primaryUrl'] : '';
    $secondary_text  = isset( $attributes['secondaryText'] ) ? $attributes['secondaryText'] : '';
    $secondary_url   = isset( $attributes['secondaryUrl'] ) ? $attributes['secondaryUrl'] : '';
    $image_url       = isset( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : '';

    ob_start();
    ?>
    <section class="micmol-hero">
        <div class="micmol-hero__inner">
            <div class="micmol-hero__content">
                <?php if ( $subtitle ) : ?>
                    <div class="micmol-hero__subtitle"><?php echo esc_html( $subtitle ); ?></div>
                <?php endif; ?>

                <?php if ( $title_primary || $title_secondary ) : ?>
                    <h1 class="micmol-hero__title">
                        <?php if ( $title_primary ) : ?>
                            <span class="micmol-hero__title--primary"><?php echo esc_html( $title_primary ); ?></span>
                        <?php endif; ?>
                        <?php if ( $title_secondary ) : ?>
                            <span class="micmol-hero__title--secondary"><?php echo esc_html( $title_secondary ); ?></span>
                        <?php endif; ?>
                    </h1>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <div class="micmol-hero__desc"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
                <?php endif; ?>

                <div class="micmol-hero__actions">
                    <?php if ( $primary_text ) : ?>
                        <a class="micmol-button micmol-button--primary" href="<?php echo esc_url( $primary_url ); ?>"><?php echo esc_html( $primary_text ); ?></a>
                    <?php endif; ?>
                    <?php if ( $secondary_text ) : ?>
                        <a class="micmol-button micmol-button--ghost" href="<?php echo esc_url( $secondary_url ); ?>"><?php echo esc_html( $secondary_text ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="micmol-hero__meta">
                    <div class="micmol-hero__meta-item"><strong>Dispositivos</strong><br/>Todos G4+</div>
                    <div class="micmol-hero__meta-item"><strong>Plataformas</strong><br/>iOS · Android</div>
                </div>
            </div>

            <div class="micmol-hero__visual">
                <?php if ( $image_url ) : ?>
                    <div class="micmol-hero__device">
                        <div class="micmol-hero__device-frame">
                            <div class="micmol-hero__device-screen">
                                <img src="<?php echo esc_url( $image_url ); ?>" alt="" class="micmol-hero__image" />
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="micmol-hero__device">
                        <div class="micmol-hero__device-frame">
                            <div class="micmol-hero__device-screen micmol-hero__image--placeholder">&lt;imagen configurable&gt;<br/>(será en formato vertical)</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


    /**
     * Register MicMol Ecosystem Card block (single card used inside columns).
     */
    function micmol_register_ecosystem_card() {
        $dir = get_stylesheet_directory();
        $uri = get_stylesheet_directory_uri();

        wp_register_script(
            'micmol-ecosystem-card-editor',
            $uri . '/custom-blocks/micmol-ecosystem-card/block.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
            filemtime( $dir . '/custom-blocks/micmol-ecosystem-card/block.js' )
        );

        wp_register_style(
            'micmol-ecosystem-card-editor-style',
            $uri . '/custom-blocks/micmol-ecosystem-card/editor.css',
            array( 'wp-edit-blocks' ),
            filemtime( $dir . '/custom-blocks/micmol-ecosystem-card/editor.css' )
        );

        wp_register_style(
            'micmol-ecosystem-card-style',
            $uri . '/custom-blocks/micmol-ecosystem-card/style.css',
            array(),
            filemtime( $dir . '/custom-blocks/micmol-ecosystem-card/style.css' )
        );

        $card_attributes = array(
            'subtitle'    => array( 'type' => 'string', 'default' => '' ),
            'title'       => array( 'type' => 'string', 'default' => '' ),
            'description' => array( 'type' => 'string', 'default' => '' ),
            'linkText'    => array( 'type' => 'string', 'default' => 'Ver productos' ),
            'linkUrl'     => array( 'type' => 'string', 'default' => '#' ),
            'iconUrl'     => array( 'type' => 'string', 'default' => '' ),
            'iconAlt'     => array( 'type' => 'string', 'default' => '' ),
        );

        register_block_type( 'micmol/micmol-ecosystem-card', array(
            'editor_script'   => 'micmol-ecosystem-card-editor',
            'editor_style'    => 'micmol-ecosystem-card-editor-style',
            'style'           => 'micmol-ecosystem-card-style',
            'attributes'      => $card_attributes,
            'render_callback' => 'micmol_render_ecosystem_card',
        ) );
    }
    add_action( 'init', 'micmol_register_ecosystem_card' );


    /**
     * Server render callback for the ecosystem card block.
     */
    function micmol_render_ecosystem_card( $attributes, $content ) {
        $title       = isset( $attributes['title'] ) ? $attributes['title'] : '';
        $description = isset( $attributes['description'] ) ? $attributes['description'] : '';
        $link_text   = isset( $attributes['linkText'] ) ? $attributes['linkText'] : '';
        $link_url    = isset( $attributes['linkUrl'] ) ? $attributes['linkUrl'] : '';
        $icon_url    = isset( $attributes['iconUrl'] ) ? $attributes['iconUrl'] : '';
        $icon_alt    = isset( $attributes['iconAlt'] ) ? $attributes['iconAlt'] : '';

        ob_start();
        ?>
        <article class="micmol-ecosystem-card" role="group" aria-label="<?php echo esc_attr( $title ? $title : 'MicMol Ecosystem Card' ); ?>">
            <div>
                <?php if ( $icon_url ) : ?>
                    <div class="micmol-ecosystem-card__icon-wrap">
                        <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>" class="micmol-ecosystem-card__icon" />
                    </div>
                <?php endif; ?>

                <?php if ( $title ) : ?>
                    <h3 class="micmol-ecosystem-card__title"><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <div class="micmol-ecosystem-card__desc"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
                <?php endif; ?>
            </div>

            <?php if ( $link_text ) : ?>
                <div>
                    <a class="micmol-ecosystem-card__link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_text ); ?> &rarr;</a>
                </div>
            <?php endif; ?>
        </article>
        <?php

        return ob_get_clean();
    }

