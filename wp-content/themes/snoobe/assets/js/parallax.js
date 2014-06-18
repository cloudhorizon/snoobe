'use strict';

var Parallax = function(opt) {

    // Default options
    var options = {
        // Keep window sizes, so we can easily change them on window resize
        window: {
            width: 0,
            height: 0
        },
        slide: {
            elements: $('.slide'),
            width: 0,
            height: 0
        },
        container: {
            element: $('body')
        },
        parallax: {
            element: $('#parallax'),
            width: 0,
            height: 0
        },
        clouds: {
            element: $('#clouds'),
            width: 0,
            height: 0,
            constant: 0
        },
        bushes: {
            element: $('#bushes'),
            width: 0,
            height: 0,
            constant: 0
        },
        trees: {
            element: $('#trees'),
            width: 0,
            height: 0,
            constant: 0
        },
        path: {
            element: $('#path'),
            width: 0,
            height: 0,
            constant: 0
        },
        goldChest: {
            element: $('#goldChest'),
            width: 0,
            height: 0,
            constant: 0
        },
        // Default number of slides
        numberOfSlides: 7
    };

    // Extend default options with passed options
    $.extend(options, opt);

    // Save all the sizes we need in options object
    this.recalculateSizes = function() {
        // Window
        options.window.width = $(window).width();
        options.window.height = $(window).height();
        // Slide
        options.slide.width = options.window.width;
        options.slide.height = options.window.height;
        // Parallax
        options.parallax.width = options.window.width * options.numberOfSlides;
        options.parallax.height = options.window.height;
        // Clouds
        options.clouds.width = options.clouds.element.width();
        options.clouds.height = options.clouds.element.height();
        // Bushes
        options.bushes.width = options.bushes.element.width();
        options.bushes.height = options.bushes.element.height();
        // Trees
        options.trees.width = options.trees.element.width();
        options.trees.height = options.trees.element.height();
        // Path
        options.path.width = options.path.element.width();
        options.path.height = options.path.element.height();
        // goldChest
        options.goldChest.width = options.goldChest.element.width();
        options.goldChest.height = options.goldChest.element.height();
    };

    // Update sizes of all important elements
    this.updateSizes = function() {
        // Slide 
        options.slide.elements.width(options.slide.width);
        // Parallax
        options.parallax.element.width(options.parallax.width);
        options.parallax.element.height(options.parallax.height);
        // Clouds constant (we don't need to calculate this each time, just when screen is resized)
        // `0.15` is for slowing down the clouds, increase it to speed them up
        options.clouds.constant = (options.clouds.width - options.window.width) * 0.15 / (options.window.width * (options.numberOfSlides - 1));
        // Bushes constant (we don't need to calculate this each time, just when screen is resized)
        options.bushes.constant = (options.bushes.width - options.window.width) / (options.window.width * (options.numberOfSlides - 1));
        // Trees constant (we don't need to calculate this each time, just when screen is resized)
        options.trees.constant = (options.trees.width - options.window.width) / (options.window.width * (options.numberOfSlides - 1));
        // Path constant (we don't need to calculate this each time, just when screen is resized)
        options.path.constant = (options.path.width - options.window.width) / (options.window.width * (options.numberOfSlides - 1));
        // Chest constant (we don't need to calculate this each time, just when screen is resized)
        options.goldChest.constant = (options.goldChest.width - options.window.width) / (options.window.width * (options.numberOfSlides - 1));
    };

    // Resize everything
    this.resize = function() {
        // Calculate all sizes
        this.recalculateSizes();

        // And update them
        this.updateSizes();
    };

    /* Move things */
    this.move = {
        // Move body (horizontal scroll)
        body: function(event, delta, deltaFactor) {
            options.container.element.scrollLeft(parseInt($('body').scrollLeft(), 10) - (delta * deltaFactor * 0.1));
        },

        // Move clouds
        clouds: function() {
            options.clouds.element.css({
                'left': - parseInt(options.container.element.scrollLeft(), 10) * options.clouds.constant
            });
        },

        // Move bushes
        bushes: function() {
            options.bushes.element.css({
                'left': - parseInt(options.container.element.scrollLeft(), 10) * options.bushes.constant
            });
        },

        // Move trees
        trees: function() {
            options.trees.element.css({
                'left': - parseInt(options.container.element.scrollLeft(), 10) * options.trees.constant
            });
        },

        // Move path
        path: function() {
            options.path.element.css({
                'left': - parseInt(options.container.element.scrollLeft(), 10) * options.path.constant
            });
        },

        // Move chest
        goldChest: function() {
            options.goldChest.element.css({
                'margin-left': - parseInt(options.container.element.scrollLeft(), 10) / 5.5
            });
        }
    };

    // Configurate mousewheel
    this.onMouseWheel = function(event, delta, deltaFactor) {
        if ($('body').hasClass('home')) {
            this.move.body(options.container.element, delta, deltaFactor);
            this.move.clouds();
            this.move.bushes();
            this.move.trees();
            this.move.path();
            this.move.goldChest();

            // Prevent default action
            event.preventDefault();
        }
    };

    // Move to position
    // To test `parallax.moveToPosition(6000);
    // !TODO: Add animation
    this.moveToPosition = function(position) {
        options.container.element.scrollLeft(position);
        this.move.clouds();
        this.move.bushes();
        this.move.trees();
        this.move.path();
        this.move.goldChest();
    };

    // ...


    // Initial screen resize calculations
    this.resize();

    // Start mousewheel on body
    var self = this;
    options.container.element.mousewheel(function(event, delta) {
        // We use `event.deltaFactor` to fix the scrooll with mouse
        // `delta` is the combined value of vertical and horizontal scrolls
        self.onMouseWheel.apply(self, [event, delta, event.deltaFactor]);
    });

    self = this;
    $(window).on('resize', function() {
        self.resize();
    });

    // Just a tmp log
    console.log(options);

    // return Parallax;
};
