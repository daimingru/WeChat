var rev          = require('gulp-rev');
var gulp         = require('gulp');
var sass         = require('gulp-sass');
var shell        = require('gulp-shell');
var uglify       = require('gulp-uglify');
var replace      = require('gulp-replace');
var flatten      = require('gulp-flatten');
var imagemin     = require('gulp-imagemin');
var revCollector = require('gulp-rev-collector');

var config = {
    public: {
        hotfix: 'http://static.okay.cn',
        master: 'http://static.okay.cn'
    }
}

//删除上一次生成
gulp.task('mall-clean', shell.task([
    'rm -rf template',
    'rm -rf static'
]))

//压缩HTML MD5
gulp.task('mall-minify-hotfix', function () {
    return gulp.src(['static/**/*.json', 'Apps/OkayMall/View/default/**/*.html']) // 要压缩的html文件
        .pipe(replace('__PUBLIC__/js', config.public.hotfix))
        .pipe(replace('__PUBLIC__/css', config.public.hotfix))
        .pipe(replace("{:C('DOMAIN_STATIC')}/js", config.public.hotfix))
        .pipe(replace("{:C('DOMAIN_STATIC')}/css", config.public.hotfix))
        .pipe(revCollector())
        .pipe(gulp.dest('Apps/OkayMall/View/template'));
});


//编译scss(在JS之前编译)
gulp.task('mall-minify-sass', function(){
    return gulp.src(['Application/Home/View/**/css/*.scss','Application/Home/View/**/**/css/*.scss'])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        //.pipe(rev())
        .pipe(gulp.dest('static/view'));
        //.pipe(rev.manifest())
        //.pipe(gulp.dest('static/manifest-css'));
});

//压缩JS
gulp.task('mall-minify-js', function() {
    return gulp.src(['Application/Home/View/**/js/*.js','Application/Home/View/**/**/js/*.js'])
        .pipe(uglify({
            mangle: true,//类型：Boolean 默认：true 是否修改变量名
            mangle: {except: ['require' ,'exports' ,'module' ,'$']}//排除混淆关键字
        }))
        //.pipe(rev())
        .pipe(gulp.dest('static/view'));
        //.pipe(rev.manifest())
        //.pipe(gulp.dest('static/manifest-js'))
});

//common js
gulp.task('mall-minify-commonjs', function() {
    return gulp.src('libs/js/**/*.js')
        .pipe(uglify({
            mangle: true,//类型：Boolean 默认：true 是否修改变量名
            mangle: {except: ['require' ,'exports' ,'module' ,'$']}//排除混淆关键字
        }))
        //.pipe(rev())
        .pipe(gulp.dest('static/view/common/js'));
        //.pipe(rev.manifest())
        //.pipe(gulp.dest('static/manifest-js'))
});


//common scss
gulp.task('mall-minify-commonsass', function(){
    return gulp.src('libs/css/**/*.css')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        //.pipe(rev())
        .pipe(gulp.dest('static/view/common/css'));
        //.pipe(rev.manifest())
        //.pipe(gulp.dest('static/manifest-css'));
});

//压缩图片
gulp.task('mall-minify-image', function() {
    return gulp.src(['Application/Home/View/**/**/images/*','Application/Home/View/**/images/*'],{base: 'View'})
        .pipe(flatten({ includeParents: [1, 1]} ))
        .pipe(imagemin())
        .pipe(gulp.dest('static'));
});


//压缩commonjs
gulp.task('mall-minify-common', function() {
    return gulp.src('Apps/OkayMall/common/js/*.js')
        .pipe(uglify({
            mangle: true,//类型：Boolean 默认：true 是否修改变量名
            mangle: {except: ['require' ,'exports' ,'module' ,'$']}//排除混淆关键字
        }))
        .pipe(gulp.dest('static/view/common/js'));
});

//压缩libs
gulp.task('mall-minify-libs', function() {
    return gulp.src('Apps/OkayMall/libs/js/*.js')
        .pipe(uglify({
            mangle: true,//类型：Boolean 默认：true 是否修改变量名
            mangle: {except: ['require' ,'exports' ,'module' ,'$']}//排除混淆关键字
        }))
        .pipe(gulp.dest('static/view/'));
});



//压缩2倍图片
gulp.task('mall-minify-imagex2', function() {
    return gulp.src(['Apps/OkayMall/common/imagesx2/*'])
        .pipe(flatten())
        .pipe(imagemin())
        .pipe(gulp.dest('static/view/common/imagesx2'));
});

//压缩common图片
gulp.task('mall-minify-common-image', function() {
    return gulp.src(['Apps/OkayMall/common/images/*'])
        .pipe(imagemin())
        .pipe(gulp.dest('static/view/common/images'));
});

//压缩gz
gulp.task('mall-compress', shell.task([
    'tar czvf template.static.tar.gz static'
]))

//监听js、scss改动
gulp.task('watch', function(){
    gulp.watch('Apps/OkayMall/View/default/**/css/*.scss', gulp.series('mall-minify-sass'));
    gulp.watch('Apps/OkayMall/View/default/**/js/*.js', gulp.series('mall-minify-js'));
    gulp.watch('Apps/OkayMall/common/js/*.js', gulp.series('mall-minify-common'));
    gulp.watch('Apps/OkayMall/common/css/*.css', gulp.series('mall-minify-sass'));
})


gulp.task('dev', gulp.series('mall-clean','mall-minify-sass', 'mall-minify-js','mall-minify-commonsass', 'mall-minify-commonjs', 'mall-minify-image',function(){
    console.log('部署完成！');
}));
