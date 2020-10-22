<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'front.home.show');

Route::name('front.')->group(function () {


    /*
    |-------------
    | Static pages
    |-------------
    */
    Route::view('page/about', 'about-us.show')->name('about.show');
    Route::view('page/terms-of-service', 'terms.show')->name('terms.show');
    Route::view('page/privacy-policy', 'privacy.show')->name('privacy.show');


    /*
    |-----------
    | Contact Us
    |-----------
    */
    Route::view('page/contact', 'contact.show')->name('contact.show');
    Route::post('inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
    Route::get('inquiry', [InquiryController::class, 'show'])->name('inquiry.show');


    /*
    |-------
    | Lesson
    |-------
    */
    Route::get('search', SearchLessonController::class)->name('search-lessons.index');
    Route::get('lesson/{lesson:slug}', LessonController::class)->name('lesson.show');


    /*
    |-------------------
    | Lesson reservation
    |-------------------
    */
    Route::post('lesson-reservation/{lesson:slug}', [LessonReservationController::class, 'store'])->name('lesson-reservation.store');
    Route::get('lesson-reservation/{lesson:slug}', [LessonReservationController::class, 'show'])->name('lesson-reservation.store');
});
