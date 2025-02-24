<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemberComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\BukuComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\KembaliComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');
Route::get('/user', UserComponent::class)->name('user')->middleware('auth');
Route::get('/member', MemberComponent::class)->name('member')->middleware('auth');
Route::get('/kategori', KategoriComponent::class)->name('kategori')->middleware('auth');
Route::get('/buku', BukuComponent::class)->name('buku')->middleware('auth');
Route::get('/pinjam', PinjamComponent::class)->name('pinjam')->middleware('auth');
Route::get('/kembali', KembaliComponent::class)->name('kembali')->middleware('auth');

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');

