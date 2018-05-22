module.exports = (grunt) ->
  @initConfig
    pkg: @file.readJSON('package.json')
    compass:
      pkg:
        options:
          config: 'config.rb'
          force: true
      dev:
        options:
          config: 'config.rb'
          force: true
          outputStyle: 'expanded'
          sourcemap: true
          noLineComments: true
    sasslint:
      options:
        configFile: '.sass-lint.yml'
      target: ['css/src/*.scss']

  @loadNpmTasks 'grunt-contrib-compass'
  @loadNpmTasks 'grunt-sass-lint'

  @registerTask 'default', ['compass:dev']
  @registerTask 'develop', ['compass:dev']
  @registerTask 'package', ['compass:pkg']

