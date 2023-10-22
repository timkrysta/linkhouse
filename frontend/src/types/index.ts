export type Article = {
    id: number;
    title: string;
    link: string;
    pubDate: string;
    category: string[];
    description: string;
    html_content?: string;
};
