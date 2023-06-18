export interface MedicineResource {
    id: number,
    name: string,
    crated_at: string,
    updated_at: string
}

export interface BloodSugarReading {
    id: number,
    date: string,
    before_breakfast: number,
    after_breakfast: number,
    before_lunch: number,
    after_lunch: number,
    before_dinner: number,
    after_dinner: number,
    note: number,
    created_at: string,
    updated_at: string,
}
