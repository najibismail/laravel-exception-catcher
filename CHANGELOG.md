# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.5] - 2025-08-19

### Changed
- Version bump to 1.0.5

## [1.0.1] - 2025-08-19

### Changed
- Enhanced README with Packagist badges (version, downloads, license, PHP version)
- Simplified installation instructions now that package is available on Packagist
- Added Quick Start section for easier setup process
- Updated author contact information
- Improved documentation structure and formatting for public release

### Fixed
- Updated installation method to use `composer require` instead of local path

## [1.0.0] - 2025-08-19

### Added
- Initial release of Laravel Catch Exception package
- Automatic exception catching and email notifications
- Support for multiple email recipients
- Responsive email templates that work on all devices and email clients
- Rate limiting to prevent email spam
- Configurable exception filtering
- Rich exception information including request data, stack trace, and user info
- Queue support for async email sending
- Built-in testing commands and web routes
- Enhanced stack trace with color coding and source type indicators
- Support for Laravel 8.x, 9.x, 10.x, and 11.x
- PHP 8.0+ compatibility

### Features
- 🚨 Automatic exception catching with Laravel integration
- 📧 Multiple recipient email notifications
- 📱 Fully responsive email design
- ⚡ Rate limiting with configurable thresholds  
- 🔧 Exception type filtering
- 📊 Comprehensive exception details
- ⚙️ Queue support for better performance
- 🧪 Built-in testing tools
- 🎨 Color-coded stack traces
