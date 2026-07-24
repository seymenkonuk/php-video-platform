<?php
// ============================================================================
// File:    ErrorViewModelFactory.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Factories;


use App\Support\Providers\LayoutDataProvider;

use App\Support\ViewModels\ErrorViewModel;


final readonly class ErrorViewModelFactory
{
    private const DEFAULT_LAYOUT = "Layouts/App";

    public function __construct(
        protected LayoutDataProvider $layoutDataProvider,
    ) {}

    public function badRequest(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Geçersiz İstek",
            description: $description ?? "Gönderilen istek işlenemedi. Lütfen bilgileri kontrol ederek tekrar deneyin.",
        );
    }

    public function unauthorized(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Oturum Gerekli",
            description: $description ?? "Bu sayfaya erişebilmek için hesabınıza giriş yapmanız gerekiyor.",
        );
    }

    public function forbidden(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Erişim Reddedildi",
            description: $description ?? "Bu işlemi gerçekleştirmek için gerekli yetkiye sahip değilsiniz.",
        );
    }

    public function notFound(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Sayfa Bulunamadı",
            description: $description ?? "Aradığınız sayfa kaldırılmış, taşınmış veya hiç var olmamış olabilir.",
        );
    }

    public function tooManyRequests(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Çok Fazla İstek",
            description: $description ?? "Kısa süre içinde çok fazla istek gönderdiniz. Lütfen bir süre bekleyip tekrar deneyin.",
        );
    }

    public function serverError(
        ?string $title = null,
        ?string $description = null,
        string $layout = self::DEFAULT_LAYOUT,
    ): ErrorViewModel {
        return $this->create(
            layout: $layout,
            title: $title ?? "Sunucu Hatası",
            description: $description ?? "İsteğiniz işlenirken beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyin.",
        );
    }

    private function create(
        string $layout,
        string $title,
        string $description,
    ): ErrorViewModel {
        return new ErrorViewModel(
            layout: $layout,
            layoutData: (array) $this->layoutDataProvider->forLayout(
                layout: $layout,
                title: $title,
                description: $description,
            ),
            title: $title,
            description: $description,
        );
    }
}
