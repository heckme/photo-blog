export class Photo {
    id: number;
    photo_id: number;
    created_by_user_id: number;
    url: string;
    avg_color: string;
    description: string;
    created_at: string;
    updated_at: string;
    exif: any;
    thumbnails: any;
    tags: Array<any> = [];

    setUploadedPhotoAttributes(attributes): void {
        this.photo_id = attributes.id;
        this.created_by_user_id = attributes.created_by_user_id;
        this.url = attributes.url;
        this.avg_color = attributes.avg_color;
        this.created_at = attributes.created_at;
        this.updated_at = attributes.updated_at;
        this.exif = attributes.exif;
        this.thumbnails = attributes.thumbnails;
    }

    setPublishedPhotoAttributes(attributes): void {
        this.id = attributes.id;
        this.created_by_user_id = attributes.created_by_user_id;
        this.url = attributes.url;
        this.avg_color = attributes.avg_color;
        this.description = attributes.description;
        this.created_at = attributes.created_at;
        this.updated_at = attributes.updated_at;
        this.exif = attributes.exif;
        this.thumbnails = attributes.thumbnails;
        this.tags = attributes.tags;
    }
}
