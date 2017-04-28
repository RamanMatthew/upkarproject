module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dist: {
                options: { style: 'compressed', sourcemap: 'none' },
                files: {
                    'web/css/app.css': 'app/Resources/assets/sass/app.scss',
                }
            }
        },

    });

    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['sass']);

};
